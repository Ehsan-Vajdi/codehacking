@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Posts</h2>
        </div>
    </div>

    <!--
        errors view section
    -->

    <!--  alert for successful post delete  -->
    @if(session('post_deleted'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('post_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to delete post  -->
    @if(session('post_not_deleted'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('post_not_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for successful post update  -->
    @if(session('update_post'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('update_post')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to update post  -->
    @if(session('not_able_update_post'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('not_able_update_post')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for creating post  -->
    @if(session('post_created'))
        <div class="sufee-alert alert with-close alert-info alert-dismissible fade show m-t-15 m-b-0">
            {{session('post_created')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for failing to creat post  -->
    @if(session('post_not_created'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show m-t-15 m-b-0">
            {{session('post_not_created')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--
        /errors view section
    -->

    <div class="row m-t-30">
        <div class="col-md-12">
            <!-- DATA TABLE-->
            <div class="table-responsive m-b-40">
                <table class="table table-borderless table-data3">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Owner</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>

                    <!--  if there is any user in database  -->
                    @if($posts)

                        @foreach($posts as $post )
                            <tr>
                                <td>{{$post->id}}</td><!--  check if user has photo  -->
                                <td><div class="image img-responsive img-120"><img src="{{$post->photo_id ? asset($post->photo->file) : 'http://placehold.it/140x100'}}" alt="post_image"></div></td>
                                <td><a href="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></td>
                                <td>{{$post->body}}</td>
                                <td>{{$post->user_id ? $post->user->name : 'No One'}}</td>
                                <td>{{$post->category_id ? $post->category->name : 'Uncategorised'}}</td>
                                <td>{{$post->created_at->diffForHumans()}}</td>
                                <td>{{$post->updated_at->diffForHumans()}}</td>
                            </tr>
                        @endforeach

                    @endif

                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE-->
        </div>
    </div>

@endsection
