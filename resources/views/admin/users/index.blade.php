@extends('layouts.admin')
@section('content')
<h1>Users</h1>
<table class="table">
    <thead>
        <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        </tr>
    </thead>
    <tbody>
    @if($users)
        @foreach($users as $user)
        <tr>
        <td>{{$user->id}}</td>
        @if($user->photo) 
        <td><img height="50" src="{{$user->photo->path}}" > </td>   
        @else 
        <td><img height="50" src="{{$user->photo ? $user->photo['path'] : "http://placehold.it/400x400"}}" alt="" class="img-responsive img-rounded"></td> 
        @endif
        {{-- <td>{{$user->photo ? '$user->photo->path' : 'no user photo'}}</td> --}}
        <td><a href="{{route('edit', ['id' => $user->id])}}">{{$user->name}}</a></td>
        <td>{{$user->email}}</td>
        <td>{{$user->role['name']}}</td>
        <td>{{$user->is_active == 1 ? 'Active' : 'NotActive'}}</td>
        <td>{{$user->created_at->diffForHumans()}}</td>
        <td>{{$user->updated_at->diffForHumans()}}</td>
        </tr>       
        @endforeach
    @endif 
    </tbody>
</table>
@endsection