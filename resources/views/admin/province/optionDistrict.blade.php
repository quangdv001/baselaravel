@if(sizeof($district) > 0)
    @foreach ($district as $k => $v)
        <option value="{{ $k }}" @if($select == $k) selected @endif>{{ $v }}</option>
    @endforeach
@endif