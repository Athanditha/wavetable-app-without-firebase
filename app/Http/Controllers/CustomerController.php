<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     */
    public function index()
    {
        $customers = Customer::all();
        return CustomerResource::collection($customers);
    }

    /**
     * Store a newly created customer in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_name' => 'required|string|max:255|unique:customers,user_name',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8',
            'contact_no' => 'nullable|string|max:15',
        ]);

        $validated['password'] = bcrypt($validated['password']); // Hash the password

        $customer = Customer::create($validated);

        return new CustomerResource($customer);
    }

    /**
     * Display the specified customer.
     */
    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }

    /**
     * Update the specified customer in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'user_name' => 'sometimes|string|max:255|unique:customers,user_name,' . $customer->id,
            'first_name' => 'sometimes|string|max:255',
            'last_name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:customers,email,' . $customer->id,
            'password' => 'sometimes|string|min:8',
            'contact_no' => 'nullable|string|max:15',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = bcrypt($validated['password']); // Hash the new password
        }

        $customer->update($validated);

        return new CustomerResource($customer);
    }

    /**
     * Remove the specified customer from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return response()->json(['message' => 'Customer deleted successfully']);
    }
}
