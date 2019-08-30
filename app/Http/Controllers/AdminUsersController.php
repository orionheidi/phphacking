<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
    
    public function create()
    {
        // $roles = Role::pluck('name','id')->all();
        $roles = Role::all();
        return view('admin.users.create',compact('roles'));
    }

    public function store(Request  $request)
    {
        $this->validate($request,
        [
            'name' => 'required|min:2',
            'email' => 'required||string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = $request->all();
        $user['password'] = bcrypt($request->password);
        $role = $request['role'];
        $user['role_id'] = $role;
        $isActive = $request['is_active'];
        $user['is_active'] = $isActive;

        if($file = $request->file('file')){

            $name = $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['path'=> $name]);

            $user['photo_id'] = $photo->id;
        }
        // dd($user);
        User::create($user);

        return redirect('/admin/users')->with('success_message', 'Article successfully created!');
  
    }

    public function show($id)
    {
        return view('admin.users.show');
    }

    public function edit($id)
    {
        return view('admin.users.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
