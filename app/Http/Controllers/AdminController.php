<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::with('roles')->select('*')->get();

        // echo "<pre>";
        // print_r($admins->toArray());
        // exit();

        return Inertia::render('Admin/index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Admin/Create',[
            "roles"=>Role::pluck('name')->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|',
            'roles' => 'array|min:1', // 👈 make sure this matches
        ]);
        $admin = new Admin();
        $admin->name = $input['name'];
        $admin->email = $input['email'];
        $admin->password = Hash::make($input['email']);
        $admin->save();

        $admin->syncRoles($input['roles']);

        return to_route("admins.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Admin::destroy($id);
        return to_route('admins.index');
    }
}
