@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Categories</h2>
        </div>
    </div>

    <div class="row m-t-30">
        <div class="col-md-12">
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
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($categories as $category )
                            <tr>
                                <td>{{$category->id}}</td>
                                <td>{{$category->name}}</td>
                                <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'No Date'}}</td>
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
