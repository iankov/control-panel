@extends('icp::master')

@section('title', 'Edit user')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('admin.update', $user->id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            @include('icp::admin.form')
        </form>
    </div>


@endsection