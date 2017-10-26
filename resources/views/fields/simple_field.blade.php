<div class="containerField simpleField {{isset($classes) ? $classes : ''}} @if($type=="hidden")hidden @else  @endif ">
    <label for="{{$name}}" class="fieldLabel">{{$label}}</label>
    <input
            id="{{$name}}"
            name="{{$name}}"
            show-search="{{$search}}"
            double-check="{{$doubleCheck}}"
            unique="{{$unique}}"
            type="{{$type}}"
            value="{{$value}}"
            {{isset($attributes) ? $attributes : ''}}
            class="user-input"/>
</div>