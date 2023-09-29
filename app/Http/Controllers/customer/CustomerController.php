<?php

namespace App\Http\Controllers\customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::get();
        return view('pages.costomer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.costomer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $customers = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $customer = Customer::find($id);

    if (!$customer) {
        return redirect()->route('customer.index')->with('error', 'Customer not found');
    }
    return view('pages.costomer.edit', ['customer' => $customer]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with('error', 'Customer not found');
        }

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('customer.index')->with('success', 'Customer updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Customer $customer)
    {
        $customers = Customer::destroy($request->id);
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully');
    }
}
