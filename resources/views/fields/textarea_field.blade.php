<div class="containerField simpleField  @if($type=="hidden")hidden @else  @endif">
    <label for="{{$name}}">{{$label}}</label>
    <textarea
            id="{{$name}}"
            name="{{$name}}"
            show-search="{{$search}}"
            double-check="{{$doubleCheck}}"
            unique="{{$unique}}"
            {{isset($attributes) ? $attributes : ''}}
            class="user-input">{{$value}}</textarea>
</div>