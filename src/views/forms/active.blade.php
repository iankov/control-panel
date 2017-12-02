@if($action)
    <span style="cursor: pointer;" data-method="PUT" data-action="{{$action}}" class="label {{$active ? 'label-success' : 'label-warning'}}">
        {{$active ? 'Yes' : 'No'}}
    </span>
@else
    <span class="label {{$active ? 'label-success' : 'label-warning'}}">{{$active ? 'Yes' : 'No'}}</span>
@endif