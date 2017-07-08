<?php

namespace App\Http\Controllers\Api;

use App\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $goods  =   Goods::findOrFail($request->input('id'));

        return response()->json($goods);
    }
}
