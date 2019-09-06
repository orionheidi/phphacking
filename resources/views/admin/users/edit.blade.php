@extends('layouts.admin')

@section('content')

    <form method="POST" action="{{ route('update', ['id' => $user->id]) }}"  id="createForm"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <h1>Edit User</h1>
        <div class="col-sm-3">
        <img src="{{$user->photo ? $user->photo['path'] : "http://placehold.it/400x400"}}" alt="" class="img-responsive img-rounded"> 
        </div>
        <div class="col-sm-9">
        <div class="form-group">
            <label for="formGroupExampleInput">User Name</label>
            <input type="text" name="name" class="form-control" id="formGroupExampleInput" value={{ $user->name }}  type="text" class="form-control" value="{{ old('name') }}" autofocus>
        </div>
        <div class="form-group">
                <label for="formGroupExampleInput">Email</label>
                <input type="text" name="email" class="form-control" id="formGroupExampleInput" value={{ $user->email }}  type="text" class="form-control" value="{{ old('email') }}" autofocus>
            </div>
        <div class="form-group">    
            <label>Is user active?</label>
            <select class="form-control" name="is_active" id="is_active">
                <option  value="1" @if (('is_active') == 1) selected @endif>Active </option>
                <option  value="0" @if (('is_active') == 0) selected @endif>Not Active</option>
        </select>
        </div>
        <div class="form-group"> 
                <label>Select Role</label>
                <select class="form-control" name="role">
                    @foreach ( $roles as $role )
                      <option value="{{$role['id']}}">{{ $role['name'] }}</option>
                    @endforeach
                </select>
        </div>
        <div class="form-group row">
            <label for="file" class="col-4 col-form-label">Choose photo</label>
            <input id="file" name="file" type="file" class="form-control-file" style="padding:15px">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div>
      @include('partials.form_errors')
    </div>
@endsection