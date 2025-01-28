<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class WishlistController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = Firebase::database();
    }

    public function index()
    {
        $wishlists = $this->database->getReference('wishlists')->getValue();
        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'item_amt' => 'required|numeric'
        ]);

        $wishlistRef = $this->database->getReference('wishlists')->push($validated);
        
        return response()->json([
            'message' => 'Wishlist created successfully',
            'id' => $wishlistRef->getKey()
        ]);
    }

    public function show($id)
    {
        $wishlist = $this->database->getReference('wishlists/' . $id)->getValue();
        
        if (!$wishlist) {
            return response()->json(['message' => 'Wishlist not found'], 404);
        }

        return response()->json($wishlist);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required',
            'item_amt' => 'required|numeric'
        ]);

        $this->database->getReference('wishlists/' . $id)->update($validated);
        
        return response()->json(['message' => 'Wishlist updated successfully']);
    }

    public function destroy($id)
    {
        $this->database->getReference('wishlists/' . $id)->remove();
        return response()->json(['message' => 'Wishlist deleted successfully']);
    }
} 