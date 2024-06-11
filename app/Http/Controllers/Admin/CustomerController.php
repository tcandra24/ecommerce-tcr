<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\CustomerStoreRequest;
use App\Http\Requests\Admin\CustomerUpdateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('admin.customers.index', [ 'customers' => $customers ]);
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(CustomerStoreRequest $request)
    {
        try {
            Customer::create([
                'code' => $request->code,
                'name' => $request->name,
                'email'  => $request->email,
                'password' => Hash::make($request->password),
                'company' => $request->company,
                'address' => $request->address,
                'city' => $request->city,
                'phone' => $request->phone,
            ]);

            return redirect()->to('/admin/customers')->with('success', 'Customer saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', ['customer' => $customer]);
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        try {
            if($request->password == '') {
                $customer->update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'email'  => $request->email,
                    'company' => $request->company,
                    'address' => $request->address,
                    'city' => $request->city,
                    'phone' => $request->phone,
                ]);
            } else {
                $customer->update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'email'  => $request->email,
                    'password' => Hash::make($request->password),
                    'company' => $request->company,
                    'address' => $request->address,
                    'city' => $request->city,
                    'phone' => $request->phone,
                ]);
            }

            return redirect()->to('/admin/customers')->with('success', 'Customer saved successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
