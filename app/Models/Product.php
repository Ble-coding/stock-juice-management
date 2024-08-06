<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'stock_quantity', 'user_id'
    ];


    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->sales()->each(function ($sale) {
                $sale->delete();
            });
        });

        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }

    
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
