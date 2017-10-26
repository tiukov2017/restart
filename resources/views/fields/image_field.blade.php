<div class="containerField @if($type=="hidden")hidden @else  @endif">
    <label class="fieldLabel">{{$label}}</label>
    <img src="{{$value}}" class="replaceAbleImage empty_input img-responsive" data-target="#{{$name}}" data-default="{{$value}}">
    <input
            type="hidden"
            id="{{$name}}"
            name="{{$name}}"
            show-search="{{$search}}"
            double-check="{{$doubleCheck}}"
            unique="{{$unique}}"
            {{isset($attributes) ? $attributes : ''}}
            class="user-input"/>
</div>