<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    // Les attributs qui peuvent être massivement assignés
    protected $fillable = [
        'product_id',
         'path'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
