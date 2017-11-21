@extends('icp::master')

@section('title', 'Edit page')

@section('content')

    <div class="box box-warning">
        <form class="form-horizontal" id="form" action="{{icp_route('static.update', $page->id)}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">

            @include('icp::static.form')
        </form>
    </div>

@endsection