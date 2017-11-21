@extends('icp::master')

@section('title', 'Create user')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('admin.store')}}" method="post">
            {{csrf_field()}}
            @include('icp::admin.form')
        </form>
    </div>


@endsection