<?php

namespace App\Http\Controllers\user;

use App\Models\City;
use App\Models\User;
use App\Models\Customer;
use App\Models\Salesperson;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\CreateCustomerRequest;
use App\Http\Requests\user\UpdateCustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $this->authorize('view-customer');

        $customers = Customer::all();
        $cities = City::all();
        $salespersons = Salesperson::with('user')->get();

        return view('user.customers.index', compact('customers', 'cities', 'salespersons'));
    }

    public function store(CreateCustomerRequest $request)
    {
        $this->authorize('create-customer');

        $data = $request->validated();
        $data['country_id'] = $this->determineCountryId($data['city_id']);
        $customerData = $this->getCustomerData($data);
        $customerAddressData = $this->getCustomerAddressData($data);

        DB::transaction(function () use ($customerData, $customerAddressData) {
            $customer = Customer::create($customerData);
            $customer->address()->create($customerAddressData);
        });

        return back()->with('success', 'Customer created');
    }

    public function show(Customer $customer)
    {
        $this->authorize('view-customer');

        return view('user.customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $this->authorize('edit-customer');

        $cities = City::all();
        $salespersons = Salesperson::with('user')->get();

        return view('user.customers.edit', compact('customer', 'salespersons', 'cities'));
    }


    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorize('edit-customer');
        $data = $request->validated();
        $data['country_id'] = $this->determineCountryId($data['city_id']);
        $customerData = $this->getCustomerData($data);
        $customerAddressData = $this->getCustomerAddressData($data);

        DB::transaction(function () use ($customer, $customerData, $customerAddressData) {
            $customer->update($customerData);
            $customer->address()->update($customerAddressData);
        });

        return redirect()->route('user.customers.index')->with('success', 'Customer updated');
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete-customer');

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
            'salesperson_id' => $data['salesperson_id'],
        ];
    }

    private function getCustomerAddressData($data)
    {
        $addressData = [
            'name' => $data['address'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
        ];

        // Conditionally add 'lang' and 'lat' keys if they exist in $data
        $addressData += isset($data['lang']) ? ['lang' => $data['lang']] : [];
        $addressData += isset($data['lat']) ? ['lat' => $data['lat']] : [];

        return $addressData;
    }

    public function determineCountryId($cityId)
    {
        $city = City::find($cityId);

        return $city->country_id;
    }
}
