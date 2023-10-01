<?php

namespace App\Http\Controllers\administrator;

use App\Models\User;
use App\Models\Status;
use App\Models\Country;
use App\Models\UserType;
use App\Models\Salesperson;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\administrator\CreateSalespersonRequest;
use App\Http\Requests\administrator\UpdateSalespersonRequest;

class SalespersonController extends Controller
{

    public function index()
    {
        $this->authorize('view-salesperson');
        $salespersons = Salesperson::with('user')->get();
        $permissions = Config::get('permissions.salesperson-permissions', []);
        $countries = Country::all();

        return view('administrator.salesperson.index', compact('salespersons', 'permissions', 'countries'));
    }

    public function store(CreateSalespersonRequest $request)
    {
        $this->authorize('create-salesperson');
        $data = $request->validated();
        $data['status_id'] = Status::ACTIVE;
        $data['user_type_id'] = UserType::SALESPERSON;
        $user = User::create(Arr::except($data, 'permissions'));
        $salesperson = $user->salesperson()->create([]);
        $user->syncPermissions($data['permissions']);
        $selectedCountries = Arr::get($data, 'countries', []);
        $salesperson->countries()->attach($selectedCountries);

        return back()->with('success', 'salesperson created');
    }







    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $this->authorize('view-salesperson');
        $salesperson = User::whereRole('salesperson')->findOrfail($userId);

        return view('administrator.salespersons.show', compact('salesperson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salesperson $salesperson)
    {
        $this->authorize('edit-salesperson');
        $salesperson->load(['user.permissions', 'countries']);
        $permissions = Permission::all();
        $selectedPermissions = $salesperson->user->permissions->pluck('name')->toArray();
        $countries = Country::all();
        $selectedCountries = $salesperson->countries->pluck('name')->toArray();

        return view('administrator.salesperson.edit', compact(
            'salesperson',
            'permissions',
            'selectedPermissions',
            'countries',
            'selectedCountries'
        ));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalespersonRequest $request, Salesperson $salesperson)
    {
        $this->authorize('edit-salesperson');
        $data = $request->validated();
        $user = $salesperson->user;
        $user->update(Arr::except($data, 'permissions'));
        $user->revokePermissionTo($user->permissions);
        $user->syncPermissions($data['permissions']);

        return to_route('administrator.salespersons.index')->with('success', 'salesperson updated');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salesperson $salesperson)
    {
        $salesperson->user->delete();

        return back()->with('success', 'salesperson deleted');
    }
}
