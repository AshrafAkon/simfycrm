@extends('layouts.admin')


@section('main-content')
    
    <form action="{{ isset($user) ? route('users.update', $user->id) :  route('users.store') }}" method="POST">
        @csrf
        @if(isset($user))
          @method('PATCH')
        @endif
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input class="form-control" placeholder="Name" name="name" 
                    value = "{{isset($user) ? $user->name : ''}}"
                    />

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input class="form-control" placeholder="Email" name="email" 
                    value = "{{isset($user) ? $user->email: ''}}"/>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    <input class="form-control" placeholder="Password" name="password" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    <input class="form-control" placeholder="Confirm password" name="confirm-password" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    <select name="roles" class="form-control">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}"
                            @if(isset($user) && $user->getRoleNames()[0] == $role)
                                 selected
                            @endif
                            >{{ $role }}</option>
                            
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">{{isset($user) ? "Update User" :  
                "Create User"}}</button>
            </div>
        </div>


    </form>

@endsection
