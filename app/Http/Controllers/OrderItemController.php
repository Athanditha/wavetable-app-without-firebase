<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Resources\OrderItemResource;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the order items.
     * 
     */
    public function index()
    {
        $orderItems = OrderItem::all();
        return OrderItemResource::collection($orderItems);
    }

    /**
     * Store a newly created order item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'equipment_id' => 'required|exists:items,id', // Assuming "Item" is the related equipment model
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::create($validated);

        return new OrderItemResource($orderItem);
    }

    /**
     * Display the specified order item.
     */
    public function show(OrderItem $orderItem)
    {
        $orderItem->load(['order', 'equipment']);
        return new OrderItemResource($orderItem);
    }

    /**
     * Update the specified order item in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $validated = $request->validate([
            'order_id' => 'sometimes|required|exists:orders,id',
            'equipment_id' => 'sometimes|required|exists:items,id',
            'quantity' => 'sometimes|required|integer|min:1',
            'price' => 'sometimes|required|numeric|min:0',
        ]);

        $orderItem->update($validated);

        return new OrderItemResource($orderItem);
    }

    /**
     * Remove the specified order item from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return response()->json(['message' => 'Order item deleted successfully'], 204);
    }
}
