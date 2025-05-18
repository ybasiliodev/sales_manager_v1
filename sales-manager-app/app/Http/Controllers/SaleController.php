<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $sales = Sale::with('seller')
            ->orderBy('sale_date', 'desc')
            ->paginate($perPage);

        return response()->json($sales);
    }

    public function bySeller(Request $request, $sellerId)
    {
        $perPage = $request->get('per_page', 10);

        $sales = Sale::where('seller_id', $sellerId)
            ->with('seller')
            ->orderBy('sale_date', 'desc')
            ->paginate($perPage);

        return response()->json($sales);
    }

    public function store(Request $request): JsonResponse
    {
        $sale = new Sale();

        $validator = Validator::make($request->all(), $sale->rules(), $sale->feedback());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $createdSale = Sale::create($request->only([
            'description',
            'value',
            'sale_date',
            'seller_id'
        ]));

        return response()->json([
            'message' => 'Venda cadastrada com sucesso!',
            'data' => $createdSale
        ], 201);
    }
}
