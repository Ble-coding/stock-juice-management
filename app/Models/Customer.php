<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes; // Activer le soft delete

    protected $fillable = [
         'user_id', 'code_customer',
         'name', 'email', 'phone', 'address', 'kyc_status', 'last_login', 'registered_at'
    ];


    protected $dates = ['deleted_at']; // Champs pour la date de suppression

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
