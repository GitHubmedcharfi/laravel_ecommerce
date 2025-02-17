<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    // LigneCommande model
public function commande()
{
    return $this->belongsTo(Commande::class, 'commande_id', 'id');
}

public function product()
{
    return $this->belongsTo(Product::class, 'product_id', 'id');
}

}
