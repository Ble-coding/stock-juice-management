<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes; // Activer le soft delete

    protected $fillable = [
         'user_id',
         'title', 'regular_price', 'sale_price', 'stock', 'sku', 'image', 'status','is_starred'
         // 'name', 'description', 'price', 'stock_quantity', 'category_id',user-id
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

    public function images()
    {
        return $this->hasMany(Image::class);
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


    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tag');
    }



}
