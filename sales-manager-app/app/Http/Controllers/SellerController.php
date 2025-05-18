<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SellerController extends Controller
{
    public function index(): JsonResponse
    {
        $sellers = Seller::all();

        return response()->json($sellers);
    }

    public function store(Request $request): JsonResponse
    {
        $seller = new Seller();

        $validator = Validator::make($request->all(), $seller->rules(), $seller->feedback());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $createdSeller = Seller::create($request->only(['name', 'email']));

        return response()->json([
            'message' => 'Vendedor cadastrado com sucesso!',
            'data' => $createdSeller
        ], 201);
    }
}
