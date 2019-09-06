<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserEditRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use DB;

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

    public function store(UserCreateRequest $request)
    {
        if(trim($request->password) == ''){
            $user = $request->except('password');
        }else{
            $user = $request->all();
            $user['password'] = bcrypt($request->password);
        }

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
        $user = User::findOrFail($id);
        $roles = Role::all(['id','name']);
        // $roles = DB::table('roles')->pluck('id', 'name');
            
        // $roles =  DB::table('roles')->get();
        // dd($user);
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

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
        
        $user->update($input);
        return redirect('/admin/users');
    }

    public function destroy($id)
    {
        //
    }
}
