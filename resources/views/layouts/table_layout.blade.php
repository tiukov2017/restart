@extends('layouts.app')


@section('styles')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    @yield('table_styles')
@endsection
@section('content')

@role('admin')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        @if(!(isset($dropdown)))
        <div class="panel panel-default">
            <div class="panel-heading">
                <span data-form="#add-form" class="glyphicon glyphicon-plus-sign"></span>

                @yield('addHeader')
            </div>
        </div>
            @endif
@endrole
         @yield('form')
         <!-- -->
        @yield('table')

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('js/tables_common.js') }}"></script>
    <script src="{{ asset('js/table_init.js') }}"></script>

    @yield('table_scripts')
@endsection