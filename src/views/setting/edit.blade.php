@extends('icp::master')

@section('title', 'Edit setting')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('setting.update', $setting->id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            @include('icp::setting.form')
        </form>
    </div>

@endsection