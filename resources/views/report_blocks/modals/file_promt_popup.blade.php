@extends('popup_layout')

@section('modal-body')
    <div class="row">
    <form action="{{route('simpleupload')}}" id="upload-form" enctype="multipart/form-data" method="post">
            <input type="text" class="form-control" id="url-src"  />
            <input type="file" name="image" class="" id="file-system-src" style="display:none"  accept="image/*"/>
            <button type="button" id="upload-button" class="btn btn-primary">בחר קובץ</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
    </div>
@endsection