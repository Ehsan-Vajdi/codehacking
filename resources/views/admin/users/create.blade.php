@extends('layouts.admin')

@section('content')
    <div class="col-md-12 m-b-30">
        <div class="overview-wrap">
            <h2 class="title-1">Create User</h2>
        </div>
    </div>

    <div class="container">
        <div class="col-md-9">

            {!! Form::open(['method' => 'post', 'action' => 'AdminUsersController@store', 'files' => true]) !!}

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
                {!! Form::select('role_id', ['' => 'Choose a Role'] + $roles, null, ['class' => 'form-control']); !!}
            </div>

            <div class="form-group">
                {!! Form::label('is_active', '*Status:') !!}
                {!! Form::select('is_active', [1 => 'Active', 0 => 'Not Active'], 0, ['class' => 'form-control']); !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Photo:') !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', '*Password') !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            @csrf
            @include('includes.form_error')

            <diw class="row">
                <div class="form-group col-sm-2">
                    {!! Form::submit('Create User', ['class' => 'btn btn-primary']) !!}
                </div>

                <div class="form-group col-sm-2">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </diw>

            {!! Form::close() !!}
        </div>
    </div>
@endsection

