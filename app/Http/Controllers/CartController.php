<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class CartController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = Firebase::database();
    }

    public function index()
    {
        $carts = $this->database->getReference('carts')->getValue();
        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'item_amt' => 'required|numeric'
        ]);

        $cartRef = $this->database->getReference('carts')->push($validated);
        
        return response()->json([
            'message' => 'Cart created successfully',
            'id' => $cartRef->getKey()
        ]);
    }

    public function show($id)
    {
        $cart = $this->database->getReference('carts/' . $id)->getValue();
        
        if (!$cart) {
            return response()->json(['message' => 'Cart not found'], 404);
        }

        return response()->json($cart);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'item_amt' => 'required|numeric'
        ]);

        $this->database->getReference('carts/' . $id)->update($validated);
        
        return response()->json(['message' => 'Cart updated successfully']);
    }

    public function destroy($id)
    {
        $this->database->getReference('carts/' . $id)->remove();
        return response()->json(['message' => 'Cart deleted successfully']);
    }
} 