<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class PageController extends Controller
{
    private $database;

    public function __construct()
    {
        $this->database = Firebase::database();
    }

    public function welcome()
    {
        return view('customer.welcome');
    }

    public function customer()
    {
        return view('custmgmt.custmain');
    }

    public function oops()
    {
        return view('customer.oops');
    }

    public function items()
    {
        return view('items.itemview');
    }

    public function home()
    {
        return view('customer.home');
    }

    public function custlogin()
    {
        return view('auth.login');
    }

    public function admin()
    {
        return view('adminlanding.admin');
    }

    public function adminlogin()
    {
        return view('logins.adminlogin');
    }

    public function custregister()
    {
        return view('auth.register');
    }

    public function analytics()
    {
        // Fetch items from Firebase
        $items = $this->database->getReference('items')->getValue() ?? [];

        // Process data for analytics
        $categoryCounts = [];
        $brandCounts = [];
        $totalValue = 0;
        $itemsByPrice = [];

        foreach ($items as $id => $item) {
            // Category distribution
            $category = $item['category'] ?? 'Uncategorized';
            $categoryCounts[$category] = ($categoryCounts[$category] ?? 0) + 1;

            // Brand distribution
            $brand = $item['brand'] ?? 'Unknown';
            $brandCounts[$brand] = ($brandCounts[$brand] ?? 0) + 1;

            // Total inventory value
            $price = floatval($item['sale_price'] ?? 0);
            $quantity = intval($item['quantity'] ?? 0);
            $totalValue += $price * $quantity;

            // Store items by price for top items chart
            $itemsByPrice[] = [
                'name' => $item['name'] ?? 'Unknown',
                'price' => $price,
                'quantity' => $quantity
            ];
        }

        // Sort items by price for top items
        usort($itemsByPrice, function($a, $b) {
            return $b['price'] - $a['price'];
        });

        // Take top 5 items
        $topItems = array_slice($itemsByPrice, 0, 5);

        $analyticsData = [
            'categories' => [
                'labels' => array_keys($categoryCounts),
                'data' => array_values($categoryCounts)
            ],
            'brands' => [
                'labels' => array_keys($brandCounts),
                'data' => array_values($brandCounts)
            ],
            'topItems' => [
                'labels' => array_map(function($item) { return $item['name']; }, $topItems),
                'data' => array_map(function($item) { return $item['price']; }, $topItems)
            ],
            'totalValue' => $totalValue,
            'totalItems' => count($items)
        ];

        return view('adminlanding.analytics', compact('analyticsData'));
    }
}
