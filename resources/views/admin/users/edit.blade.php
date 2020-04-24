@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12 m-b-30">
        <div class="overview-wrap">
            <h2 class="title-1">Edit User</h2>
        </div>
    </div>

{{--    <div class="container">--}}
    <div class="col-sm-3 m-t-30">
        <img src="{{$user->photo_id ? asset($user->photo->file) : 'http://placehold.it/400x400'}}" alt="user_image" class=" image img-thumbnail">
{{--        <img src="{{$user->photo_id ? asset($user->photo->file) : asset('images/users/default-user.jpg')}}" alt="user_image" class=" image img-thumbnail">--}}
    </div>
    <div class="col-sm-8">

        {!! Form::model($user, ['method' => 'PATCH', 'action' => ['AdminUsersController@update', $user->id], 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('name', '*Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', '*Email:') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('role_id', 'Role:') !!}
            {!! Form::select('role_id', $roles, null, ['class' => 'form-control']); !!}
        </div>

        <div class="form-group">
            {!! Form::label('is_active', '*Status:') !!}
            {!! Form::select('is_active', [1 => 'Active', 0 => 'Not Active'], null, ['class' => 'form-control']); !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        @csrf
        @include('includes.form_error')

        <!--  putting Update and Delete buttons in a row  -->
        <div class="row">
            <div class="form-group  col-sm-2">
                {!! Form::submit('Update User', ['class' => 'btn btn-primary']) !!}
            </div>

        {!! Form::close() !!}

        <!--  delete user  -->
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminUsersController@destroy', $user->id]]) !!}

            @csrf

            <div class="form-group col-sm-2">
                {!! Form::submit('Delete User', ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
{{--    </div>--}}
@endsection

