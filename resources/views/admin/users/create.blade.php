@extends('layouts.admin')

@section('content')
    <form method="POST" action="{{ route('store') }}"  id="createForm"  enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">User Name</label>
            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Enter User Name" type="text" class="form-control" value="{{ old('name') }}" autofocus>
        </div>
        <div class="form-group">
                <label for="formGroupExampleInput">Email</label>
                <input type="text" name="email" class="form-control" id="formGroupExampleInput" placeholder="Enter User Email" type="text" class="form-control" value="{{ old('email') }}" autofocus>
            </div>
        <div class="form-group">    
            <label>Is user active?</label>
            <select class="form-control" name="is_active" id="is_active">
                <option value="1" @if (('is_active') == 1) selected @endif>Active </option>
                <option value="0" @if (('is_active') == 0) selected @endif>Not Active</option>
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
                <input id="password" type="password" class="form-control" name="password" autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      @include('partials.form_errors')
@endsection