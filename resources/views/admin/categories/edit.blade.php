@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12 m-b-30">
        <div class="overview-wrap">
            <h2 class="title-1">Edit Category</h2>
        </div>
    </div>
    <div class="m-l-15">
        {!! Form::model($category, ['method' => 'PATCH', 'action' => ['AdminCategoriesController@update', $category->id]]) !!}

        <div class="form-group">
            {!! Form::label('name', 'Edit Category Name:') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        @csrf

        <div class="form-group">
            {!! Form::submit('Update Category', ['class' => 'btn btn-info']) !!}
        </div>

        {!! Form::close() !!}

        @include('includes.form_error')

    </div>


@endsection
