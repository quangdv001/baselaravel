@if(sizeof($ward) > 0)
    @foreach ($ward as $k => $v)
        <option value="{{ $k }}" @if($select == $k) selected @endif>{{ $v }}</option>
    @endforeach
@endif