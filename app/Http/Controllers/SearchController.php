<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class SearchController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = Firebase::database();
    }

    public function apiSearch(Request $request)
    {
        $query = strtolower($request->input('query'));
        $items = $this->database->getReference('items')->getValue() ?? [];
        
        $searchResults = [];
        
        if ($query && strlen($query) >= 2) {
            foreach ($items as $id => $item) {
                if (
                    stripos(strtolower($item['name'] ?? ''), $query) !== false ||
                    stripos(strtolower($item['description'] ?? ''), $query) !== false ||
                    stripos(strtolower($item['brand'] ?? ''), $query) !== false ||
                    stripos(strtolower($item['category'] ?? ''), $query) !== false
                ) {
                    $searchResults[$id] = [
                        'id' => $id,
                        'name' => $item['name'] ?? '',
                        'brand' => $item['brand'] ?? '',
                        'category' => $item['category'] ?? '',
                        'sale_price' => $item['sale_price'] ?? '',
                        'image' => $item['image'] ?? '',
                        'description' => $item['description'] ?? ''
                    ];
                }
            }
        }

        return response()->json([
            'results' => array_values($searchResults),
            'count' => count($searchResults)
        ]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = [];
        
        if ($query) {
            $allItems = $this->database->getReference('items')->getValue() ?? [];
            
            foreach ($allItems as $id => $item) {
                if (
                    stripos($item['name'] ?? '', $query) !== false ||
                    stripos($item['description'] ?? '', $query) !== false ||
                    stripos($item['brand'] ?? '', $query) !== false ||
                    stripos($item['category'] ?? '', $query) !== false
                ) {
                    $items[$id] = $item;
                }
            }
        }

        return view('search.results', [
            'results' => $items,
            'query' => $query
        ]);
    }
} 