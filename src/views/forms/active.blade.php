<form method="POST" action="{{$action}}">
    {{csrf_field()}}
    <input type="hidden" name="_method" value="PUT">

    <a href="#" onclick="$(this).closest('form').submit(); return false;" title="Toggle status">
        @if($active)
            <span class="label label-success">Yes</span>
        @else
            <span class="label label-warning">No</span>
        @endif
    </a>
</form>