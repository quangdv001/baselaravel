@if(sizeof($province) > 0)
    @foreach ($province as $k => $v)
        <option value="{{ $k }}" @if($select == $k) selected @endif>{{ $v }}</option>
    @endforeach
@endif