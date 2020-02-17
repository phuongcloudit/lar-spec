<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsersRequest;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Session;

class UserController extends Controller
{
    /**
     * Show the application users index.
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::latest()->with('roles')->paginate(50)
        ]);
    }

    /**
     * Display the specified resource edit form.
     */
    public function edit(User $user): View
    {

        $roles = Role::pluck('name', 'id');
        return view('admin.users.edit')->withUser($user)->withRoles($roles);


    }

    // protected function create()
    // {
    //     return view('admin.users.create');
    // }


    /**
     * Update the specified resource in storage.
     */
    public function update(UsersRequest $request, User $user): RedirectResponse
    {
        if ($request->filled('password')) {
            $request->merge([
                'password' => Hash::make($request->input('password'))
            ]);
        }

        $user->update(array_filter($request->only(['name', 'email', 'password'])));

        $role_ids = array_values($request->get('roles', []));
        $user->roles()->sync($role_ids);

        return redirect()->route('admin.users.edit', $user)->with('success','User updated sucessfully');
    }
   
}
