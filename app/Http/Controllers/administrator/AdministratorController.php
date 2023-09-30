<?php

namespace App\Http\Controllers\administrator;

use App\Models\User;
use App\Models\Status;
use App\Models\Invoice;
use App\Models\Salesperson;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Models\Administrator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\CreateAdministratorRequest;
use App\Http\Requests\UpdateAdministratorRequest;
use App\Models\Country;
use App\Models\UserType;
use Spatie\Permission\Models\Permission;

class AdministratorController extends Controller
{

    public function reports()
    {
        $adminCount = Administrator::count();

        $salepersonCount = Salesperson::count();

        $invoicesCount = Invoice::count();

        return view('administrator.dashboard', compact('adminCount', 'salepersonCount', 'invoicesCount'));
    }

    public function index()
    {
        $this->authorize('view-saleperson');
        $administrators = Administrator::with('user')->get();
        $permissions = Config::get('permissions.administrator-permissions', []);
        $countries = Country::all();
        return view('administrator.administrators.index', compact('administrators', 'permissions', 'countries'));
    }

    public function store(CreateAdministratorRequest $request)
    {

        $this->authorize('create-saleperson');
        $data = $request->validated();
        $data['status_id'] = Status::ACTIVE;
        $data['user_type_id'] = UserType::ADMIN;
        $user = User::create(Arr::except($data, 'permissions'));
        $user->administrator()->create([
            'country_id' => $data['country_id']
        ]);

        $user->syncPermissions($data['permissions']);

        return back()->with('success', 'administrator created');
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        $this->authorize('view-saleperson');
        $administrator = User::whereRole('administrator')->findOrfail($userId);

        return view('administrator.administrators.show', compact('administrator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Administrator $administrator)
    {
        $this->authorize('edit-saleperson');
        $administrator = $administrator->load('user');
        $permissions = Permission::all();
        $selectedPermissions = $administrator->user->permissions->pluck('name')->toArray();

        return view('administrator.administrators.edit', compact('administrator', 'permissions', 'selectedPermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdministratorRequest $request, Administrator $administrator)
    {
        $this->authorize('edit-saleperson');
        $data = $request->validated();
        $user = $administrator->user;
        $user->update(Arr::except($data, 'permissions'));
        $user->revokePermissionTo($user->permissions);
        $user->syncPermissions($data['permissions']);
        isset($data['country_id']) ?? $administrator->update(['country_id' => $data['country_id']]);

        return to_route('administrator.administrators.index')->with('success', 'administrator updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Administrator $administrator)
    {
        $administrator->user->delete();

        return back()->with('success', 'administrator deleted');
    }
}
