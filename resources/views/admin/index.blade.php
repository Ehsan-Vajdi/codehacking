@extends('layouts.admin')

@section('content')

    <!--  page header  -->
    <div class="col-md-12">
        <div class="overview-wrap">
            <h2 class="title-1">Home</h2>
        </div>
    </div>

    <!--
        errors view section
    -->

    <!--  alert for empty post table  -->
    @if(session('no_post'))
        <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show m-t-15 m-b-0">
            {{session('no_post')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

@endsection
