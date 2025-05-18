<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email'
    ];

    public function rules() {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique',
        ];
    }

    public function feedback() {
        return [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.unique' => 'O endereço de email já está cadastrado',
        ];
    }

    public function sales(): BelongsToMany
    {
        return $this->belongsToMany(Sale::class);
    }

}
