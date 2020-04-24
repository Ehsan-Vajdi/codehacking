@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12 m-b-30">
        <div class="overview-wrap">
            <h2 class="title-1">Edit Post</h2>
        </div>
    </div>

    {{--    <div class="container">--}}
    <div class="col-sm-3 m-t-30">
        <img src="{{$post->photo_id ? asset($post->photo->file) : 'http://placehold.it/400x400'}}" alt="post_image" class=" image img-thumbnail">
        {{--            <img src="{{$user->photo_id ? asset($user->photo->file) : asset('images/users/default-user.jpg')}}" alt="user_image" class=" image img-thumbnail">--}}
    </div>
    <div class="col-sm-8">

        {!! Form::model($post, ['method' => 'PATCH', 'action' => ['AdminPostsController@update', $post->id], 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('title', '*Title:') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('user_id', 'Owner:') !!}
            {!! Form::text('user_id', null, ['class' => 'form-control', 'readonly', 'hidden']) !!}
            <input type="text" placeholder="{{$post->user->name}}" disabled="" class="form-control">
        </div>

        <div class="form-group">
            {!! Form::label('category_id', '*Category:') !!}
            {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('photo_id', 'Photo:') !!}
            {!! Form::file('photo_id', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', '*Content:') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>

    @csrf
    @include('includes.form_error')

    <!--  putting Update and Delete buttons in a row  -->
        <div class="row">
            <div class="form-group  col-sm-2">
                {!! Form::submit('Update Post', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

            <!--  delete user  -->
            {!! Form::open(['method' => 'DELETE', 'action' => ['AdminPostsController@destroy', $post->id]]) !!}

            @csrf

            <div class="form-group col-sm-2">
                {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    {{--    </div>--}}

@endsection
