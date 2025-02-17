<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function lignecommandes()
    {
        return $this->hasMany(LigneCommande::class, 'product_id', 'id');
    }
}
