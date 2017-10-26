<div class="containerField simpleField">
    <div contenteditable="true" id="{{$name}}" name="{{$name}}" data-type="{{$type}}"
         show-search="{{$search}}"
         double-check="{{$doubleCheck}}"
         unique="{{$unique}}" type="{{$type}}"
         value="{{$value}}" class="user-input" {{isset($attributes) ? $attributes : ''}}></div>
</div>