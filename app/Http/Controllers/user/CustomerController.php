<?php

namespace App\Http\Controllers\user;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateCustomerRequest;
use App\Http\Requests\user\UpdateCustomerRequest;
use App\Models\User;

class CustomerController extends Controller
{
    public function index()
    {
        request()->user()->hasPermission('view-customer');

        $customers = Customer::all();
        $salepersons = User::whereRole('saleperson')->get();

        return view('user.customers.index', compact('customers', 'salepersons'));
    }

    public function store(CreateCustomerRequest $request)
    {
        request()->user()->hasPermission('create-customer');

        $data = $request->validated();
        $customerData = $this->getCustomerData($data);
        $customerAddressData = $this->getCustomerAddressData($data);
        $customer = Customer::create($customerData);
        $customer->address()->create($customerAddressData);

        return back()->with('success', 'Customer created');
    }

    public function show(Customer $customer)
    {
        request()->user()->hasPermission('view-customer');

        return view('user.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        request()->user()->hasPermission('edit-customer');

        $salepersons = User::whereRole('saleperson')->get();
        $customer->load('address', 'saleperson');

        return view('user.customers.edit', compact('customer', 'salepersons'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        request()->user()->hasPermission('edit-customer');

        $data = $request->validated();
        $customerData = $this->getCustomerData($data);
        $customerAddressData = $this->getCustomerAddressData($data);
        $customer->update($customerData);
        $customer->address()->update($customerAddressData);

        return redirect()->route('user.customers.index')->with('success', 'Customer updated');
    }

    public function destroy(Customer $customer)
    {
        request()->user()->hasPermission('delete-customer');

        $customer->delete();

        return back()->with('success', 'Customer deleted');
    }

    private function getCustomerData($data)
    {
        return [
            'name' => $data['name'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'language' => $data['language'],
            'user_id' => $data['user_id'],
        ];
    }

    private function getCustomerAddressData($data)
    {
        $addressData = [
            'name' => $data['address'],
        ];
    
        // Conditionally add 'lang' and 'lat' keys if they exist in $data
        $addressData += isset($data['lang']) ? ['lang' => $data['lang']] : [];
        $addressData += isset($data['lat']) ? ['lat' => $data['lat']] : [];
    
        return $addressData;
    }
    
}
