<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes; // Activer le soft delete

    protected $fillable = ['name', 'user_id'];


    protected $dates = ['deleted_at']; // Champs pour la date de suppression

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_tag');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });
    }
}
