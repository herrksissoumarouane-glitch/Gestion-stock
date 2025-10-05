<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
{
    $totalProducts = Product::count();
    $totalCategories = Category::count();
    $totalIn = StockMovement::where('type', 'in')->sum('quantity');
    $totalOut = StockMovement::where('type', 'out')->sum('quantity');
    $lowStock = Product::where('quantity', '<=', 5)->get();

    
    $products = Product::all();
    $labels = $products->pluck('name');
    $stockIn = [];
    $stockOut = [];

    foreach ($products as $product) {
        $stockIn[] = $product->stockMovements()->where('type', 'in')->sum('quantity');
        $stockOut[] = $product->stockMovements()->where('type', 'out')->sum('quantity');
    }

    return view('dashboard', compact(
        'totalProducts', 'totalCategories', 'totalIn', 'totalOut', 'lowStock',
        'labels', 'stockIn', 'stockOut'
    ));
}

}
