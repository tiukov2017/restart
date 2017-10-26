@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
@endsection

@section('content')
    <div id="editor">
        <div class="editor-iframes container-fluid">
           <div class="report-container expandable-container">
               @include('editor.editor_report_container',['id'=>$id])
           </div>

            <div class="check-container expandable-container">
                @include('editor.editor_check_navbar',['checkList'=>$checkList])
                @include('editor.editor_check_container')
            </div>
        </div>
    </div>

    @include('editor.editor_view_popup',['report'=>$report]);
@endsection

@section("scripts")
    <script src="{{ asset('js/check_navbar.js') }}"></script>
    <script src="{{ asset('js/editor.js') }}"></script>
    <script src="{{ asset('js/iframe_screenshot.js') }}"></script>
@endsection

