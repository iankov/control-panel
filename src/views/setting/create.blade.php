@extends('icp::master')

@section('title', 'Create setting key/value')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('setting.store')}}" method="post">
            {{csrf_field()}}
            @include('icp::setting.form')
        </form>
    </div>

@endsection