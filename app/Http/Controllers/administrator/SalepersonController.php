<?php

namespace App\Http\Controllers\administrator;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use App\Http\Requests\administrator\CreateSalepersonRequest;
use App\Http\Requests\administrator\UpdateSalepersonRequest;

class SalepersonController extends Controller
{
    public function index()
    {
        request()->user()->hasPermission('view-saleperson');
        $salepersons = User::whereRole('saleperson')->get();
        $permissions = Config::get('permissions.saleperson-permissions', []);

        return view('administrator.salepersons.index', compact('salepersons', 'permissions'));
    }

    public function store(CreateSalepersonRequest $request)
    {
        request()->user()->hasPermission('create-saleperson');
        $data = $request->validated();
        $data['permissions'] = json_encode($data['permissions']);
        $data['role'] = 'saleperson';
        $data['status_id'] = Status::ACTIVE;
        User::create($data);

        return back()->with('success', 'saleperson created');
    }

    /**
     * Display the specified resource.
     */
    public function show($userId)
    {
        request()->user()->hasPermission('view-saleperson');
        $saleperson = User::whereRole('saleperson')->findOrfail($userId);

        return view('administrator.salepersons.show', compact('saleperson'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($userId)
    {
        request()->user()->hasPermission('edit-saleperson');
        $saleperson = User::whereRole('saleperson')->findOrfail($userId);
        $permissions = json_decode($saleperson->permissions);

        return view('administrator.salepersons.edit', compact('saleperson', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSalepersonRequest $request, int $userId)
    {
        request()->user()->hasPermission('edit-saleperson');
        $data = $request->validated();
        $saleperson = User::whereRole('saleperson')->findOrfail($userId);
        $data['permissions'] = json_encode($data['permissions']);
        $saleperson->update($data);

        return to_route('administrator.salepersons.index')->with('success', 'saleperson updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($userId)
    {
        $saleperson = User::whereRole('saleperson')->findOrfail($userId);
        $saleperson->delete();

        return back()->with('success', 'saleperson deleted');
    }
}
