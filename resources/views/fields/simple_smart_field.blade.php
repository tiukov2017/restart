<div class="containerField {{isset($classes) ? $classes : ''}}  @if($type=="hidden")hidden @else  @endif">
    @if($label)
        <label for="{{$name}}" id="{{$name.'_label'}}" class="fieldLabel"  {{isset($attributes) ? $attributes : ''}}>
            {{$label}}
        </label>
    @endif
    <textarea  class="smartEditor user-input"
               id="{{$name}}" name="{{$name}}" data-type="{{$type}}" show-search="{{$search}}" double-check="{{$doubleCheck}}" unique="{{$unique}}">
</textarea>
</div>
