<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Validation\Rule;

class Sale extends Model
{
    /** @use HasFactory<\Database\Factories\SaleFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'value',
        'sale_date',
        'seller_id'
    ];

    public function rules()
    {
        return [
            'description' => 'required|string|max:255',
            'value' => 'required|decimal:8,2',
            'sale_date' => [
                'required',
                Rule::date()->beforeToday(),
            ],
            'seller_id' => 'required|integer'
        ];
    }

    public function feedback()
    {
        return [
            'description.required' => 'A descrição da venda é obrigatória',
            'value.required' => 'O valor da venda é obrigatório',
            'sale_date.required' => 'A data da venda é obrigatória',
            'seller_id.required' => 'É necessário informar o vendedor'
        ];
    }

    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
}
