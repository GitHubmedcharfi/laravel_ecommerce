<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commande;
use App\Models\LigneCommande;

class CommandeController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'qte' => 'required|integer|min:1', // Quantity must be an integer >= 1
            'idproduct' => 'required|exists:products,id', // Ensure the product exists
        ]);

        // Retrieve the current user's active commande ('en cours')
        $commande = Commande::where('client_id', Auth::user()->id)
                            ->where('etat', 'en cours')
                            ->first();

        if ($commande) {
            // Add a new LigneCommande to the existing Commande
            $ligneCommande = new LigneCommande();
            $ligneCommande->qte = $request->qte;
            $ligneCommande->product_id = $request->idproduct;
            $ligneCommande->commande_id = $commande->id;
            $ligneCommande->save();

            return redirect('/client/cart')->with('success', 'Produit ajouté au panier avec succès.');
        } else {
            // Create a new Commande if none exists
            $commande = new Commande();
            $commande->client_id = Auth::user()->id;
            $commande->etat = 'en cours';

            if ($commande->save()) {
                // Create a LigneCommande after successfully saving the Commande
                $ligneCommande = new LigneCommande();
                $ligneCommande->qte = $request->qte;
                $ligneCommande->product_id = $request->idproduct;
                $ligneCommande->commande_id = $commande->id;
                $ligneCommande->save();

                return redirect('/client/cart')->with('success', 'Produit ajouté au panier avec succès.');
            } else {
                // Handle error if Commande creation fails
                return redirect()->back()->with('error', 'Impossible de commander le produit.');
            }
        }
    }

    public function updateQuantity(Request $request, $ligneCommandeId)
    {
        // Validate the request data
        $request->validate([
            'qte' => 'required|integer|min:1',
        ]);

        $ligneCommande = LigneCommande::findOrFail($ligneCommandeId);
        $ligneCommande->qte = $request->qte;
        $ligneCommande->save();

        return redirect('/client/cart')->with('success', 'Quantité mise à jour.');
    }

    public function removeItem($ligneCommandeId)
    {
        $ligneCommande = LigneCommande::findOrFail($ligneCommandeId);
        $ligneCommande->delete();

        return redirect('/client/cart')->with('success', 'Produit retiré du panier.');
    }
}
