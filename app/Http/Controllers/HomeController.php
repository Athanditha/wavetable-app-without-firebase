<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $database;

    // Constructor to initialize the Firebase database reference
    public function __construct()
    {
        $this->database = Firebase::database();
    }

    public function index(){
        if(Auth::user()->usertype == 'admin') {
            return view('adminlanding.admin');
        } else {
            return view('customer.welcome');
        }
    }

    public function items(){
        // Make sure $this->database is initialized
        $items = $this->database->getReference('items')->getValue();
        $formattedItems = [];

        // Format data to include 'id' for each item
        if (!empty($items)) {
            foreach ($items as $id => $item) {
                $item['id'] = $id;
                $formattedItems[] = $item;
            }
        }
        return view('items.itemview', compact('formattedItems'));
    }

    
}
