@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Categories</h2>
        </div>
    </div>

    <!--
         errors view section
     -->

    <!--  alert for successful category delete  -->
    @if(session('category_deleted'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to delete category  -->
    @if(session('category_not_deleted'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_not_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for creating category  -->
    @if(session('category_created'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_created')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for failing to create category  -->
    @if(session('category_not_created'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_not_created')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for successful post category  -->
    @if(session('category_updated'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_updated')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to update category  -->
    @if(session('category_not_updated'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('category_not_updated')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--
        / End errors view section
    -->

    <div class="row col-lg-12 m-t-30">

        <div class="col-sm-12 col-md-4">
            {!! Form::open(['method' => 'POST', 'action' => 'AdminCategoriesController@store']) !!}

            <div class="form-group">
                {!! Form::label('name', '*Category Name:') !!}
                {!! Form::text('name', null, ['class' => 'form-control']) !!}
            </div>

            @csrf

            <div class="form-group">
                {!! Form::submit('Create Category', ['class' => 'btn btn-info']) !!}
            </div>

            {!! Form::close() !!}

            @include('includes.form_error')

        </div>


        <div class="col-sm-12 col-md-8 m-t-35">

            <!--  alert for empty table 'categories'  -->
            @if($categories->isEmpty())
                <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show m-t-15 m-b-0 m-l-30">
                    <p>There are no categories yet!</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            @endif

            <!-- DATA TABLE-->
            <!--  if there is any user in database  -->
            @if($categories->isNotEmpty())

                <div class="table-responsive m-b-40">
                    <table class="table table-borderless table-data3">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Created date</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category )
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'No Date'}}</td>
                                <td><a href="{{route('categories.edit', $category->id)}}" class="btn btn-outline-info btn-sm fa fa-edit"></a></td>
                                <!--  delete category form  -->
                                <td>
                                    {!! Form::open(['method' => 'DELETE', 'action' => ['AdminCategoriesController@destroy', $category->id]]) !!}

                                    @csrf

                                    <div class="form-group">
                                        {!! Form::submit('X', ['class' => 'btn btn-outline-danger btn-sm']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
                <!-- END DATA TABLE-->
            <!--  End if statement  -->
            @endif

        </div>
    </div>

@endsection
