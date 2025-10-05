<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with('product')->latest()->get();
        return view('stock.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::all();
        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
        ]);

        $movement = StockMovement::create($request->all());

        $product = Product::find($request->product_id);
        if ($request->type === 'in') {
            $product->quantity += $request->quantity;
        } else {
            $product->quantity -= $request->quantity;
        }
        $product->save();

        return redirect()->route('stock.index')->with('success', 'Stock updated.');
    }
}
