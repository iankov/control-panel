@extends('icp::master')

@section('title', 'Create static page')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('static.store')}}" method="post">
            {{csrf_field()}}
            @include('icp::static.form')
        </form>
    </div>

@endsection