<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')
@section('styles')
    <style>
        <?php include (public_path().'/css/app.css'); ?>
    </style>
    @endsection
@section('scripts')
    <script src="http://cdn.ckeditor.com/4.5.7/full-all/ckeditor.js" class="script" id="ckeeditor_script"></script>
    <script src="{{ asset('js/jquery.mark.min.js') }}"  class="script"></script>
    <script src="{{ asset('js/initCKEditors.js') }}" class="script"></script>
    <script src="{{ asset('js/report_double_check.js') }}" class="script"></script>
    <script src="{{ asset('js/reportMigrationScript.js')}}"  class="script"></script>
    <script src="{{ asset('js/report.js') }}" class="script" id="editor_script"></script>
    <script src="{{ asset('js/fields_reminder.js') }}" class="script"></script>

    @endsection
@section('content')


    <div id="menu-buttons" style="display: none">
        {{--Load menu action buttons by role--}}
        @role('admin')
        @include('reports.admin_report_menu_buttons',['shareUrl'=>$shareUrl])
        @endrole

        @role('worker')
        @include('reports.worker_report_menu_buttons')
        @endrole
    </div>
    <input type="hidden" id="user-name" value="{{$userName}}">

    @include('reports_forms.report_hidden_fields',['shareUrl'=>$shareUrl])

    <div class="container" id="reportApp">

        {!! $reportContent !!}

    </div>
@endsection