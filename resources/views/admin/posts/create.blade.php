@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Create Post</h2>
        </div>
    </div>

    <div class="container">
        <div class="col-md-9">
            {!! Form::open(['method' => 'POST', 'action' => 'AdminPostsController@store', 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('title', '*Title:') !!}
                {!! Form::text('title', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('category_id', '*Category:') !!}
                {!! Form::select('category_id', [''=>'Choose a category'] + $categories, null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo_id', 'Image:') !!}
                {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', '*Content:') !!}
                {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
            </div>



            @csrf
            @include('includes.form_error')

            <diw class="row">
                <div class="form-group col-sm-2">
                    {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
                </div>

                <div class="form-group col-sm-2">
                    <button type="reset" class="btn btn-danger">Reset</button>
                </div>
            </diw>

            {!! Form::close() !!}
        </div>
    </div>

@endsection
