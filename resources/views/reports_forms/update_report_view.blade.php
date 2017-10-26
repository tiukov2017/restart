@extends('layouts.table_layout')

@section('styles')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
@endsection
    @section('form')
@include('reports_forms.update_order_form',['dropdown'=>'none'])
        @endsection

@section('table_scripts')
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
    <script src="//cdn.datatables.net/plug-ins/1.10.12/sorting/datetime-moment.js"></script>
    <script src="{{asset('js/reports_table.js')}}"></script>
    <script src="{{asset('js/bootstrap-filestyle.min.js')}}"></script>
@endsection

