@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Users</h2>
        </div>
    </div>

    <!--
        errors view section
    -->

    <!--  alert for successful user delete  -->
    @if(session('user_deleted'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('user_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to delete user  -->
    @if(session('user_not_deleted'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('user_not_deleted')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for successful user update  -->
    @if(session('update_user'))
        <div class="sufee-alert alert with-close alert-success alert-dismissible fade show m-t-15 m-b-0">
            {{session('update_user')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for not able to update user  -->
    @if(session('not_able_update_user'))
        <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show m-t-15 m-b-0">
            {{session('not_able_update_user')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for creating user  -->
    @if(session('user_created'))
        <div class="sufee-alert alert with-close alert-info alert-dismissible fade show m-t-15 m-b-0">
            {{session('user_created')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    <!--  alert for failing to creat user  -->
    @if(session('user_not_created'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show m-t-15 m-b-0">
            {{session('user_not_created')}}
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>

                    <!--  if there is any user in database  -->
                    @if($users)

                        @foreach($users as $user )
                            <tr>
                                <td>{{$user->id}}</td><!--  check if user has photo  -->
                                <td><div class="image img-responsive img-40"><img src="{{$user->photo_id ? asset($user->photo->file) : 'http://placehold.it/400x400'}}" alt="user_image"></div></td>
                                <td><a href="{{route('users.edit', $user->id)}}">{{$user->name}}</a></td>
                                <td>{{$user->email}}</td>
                                <!--  check if user has role  -->
                                <td>{{$user->role ? $user->role->name : 'User has no role'}}</td>
                                <!--  check activity status  -->
                                @if($user->is_active == 1)
                                    <td class="process">Active</td>
                                @else
                                    <td class="denied">Not Active</td>
                                @endif

                                <td>{{$user->created_at ? $user->created_at->diffForHumans() : 'No Date'}}</td>
                                <td>{{$user->updated_at ? $user->updated_at->diffForHumans() : 'No Date'}}</td>
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
