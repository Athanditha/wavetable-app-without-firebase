<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     * 
     */
    public function index()
    {
        $orders = Order::all();
        
        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
        ]);
        
        $order = Order::create($validated);

        return new OrderResource($order);
    }

    /**
     * Display the specified order.
     */
    public function show(Order $order)
    {
        $order->load(['customer', 'orderItems']);
        return new OrderResource($order);
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'customer_id' => 'sometimes|required|exists:customers,id',
            'status' => 'sometimes|required|string|max:255',
            'total' => 'sometimes|required|numeric|min:0',
        ]);

        $order->update($validated);

        return new OrderResource($order);
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json(['message' => 'Order deleted successfully'], 204);
    }
}
