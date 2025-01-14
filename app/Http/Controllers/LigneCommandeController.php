<?php

namespace App\Http\Controllers;

use App\Models\LigneCommande;

class LigneCommandeController extends Controller
{
    public function commande()
    {
        return $this->belongsTo(Commande::class, 'commande_id', 'id');
    }

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
