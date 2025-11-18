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
    public function index(Request $request)
    {
        $input = $request->all();
        $search = $input['search']??null;

        $admins = Admin::query()->with('roles')->select('*');
        $this->applySearch($admins, $search );
        $admins = $admins->get();

        return Inertia::render('Admin/index', compact('admins'));
    }

    protected function applySearch($query, $search){
        return $query->when($search, function($query, $searchTerm) {
            $query->where(function ($q) use ($searchTerm)  {
                $q->orWhere('name', 'like', '%' . $searchTerm . '%');
                $q->orWhere('email', 'like', '%' . $searchTerm . '%');
            });
        });
    }


    public function getroles()
    {
        $roles = Role::select('id', 'name')->get();

        return response()->json($roles);
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
            'roles' => 'array|min:1', // 👈 make sure this matches
        ]);
        if($request->password && !empty($input['id'])){
            $request->validate([
                'password' => 'required',
            ]);
        }

        if (!empty($input["id"])) {
            $admin = Admin::find($input['id']);
        }else {
            $admin = new Admin();
        }

        $admin->name = $input['name'];
        $admin->email = $input['email'];
        $admin->password = Hash::make($input['password']);
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
