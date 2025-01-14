<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    // Commande model
public function lignecommandes()
{
    return $this->hasMany(LigneCommande::class, 'commande_id', 'id');
}

public function client()
{
    return $this->belongsTo(User::class, 'client_id', 'id');
}

}
