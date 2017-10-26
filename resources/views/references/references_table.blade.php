@extends('layouts.app')

@section("scripts")
<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('js/tables_common.js') }}"></script>
<script src="{{asset('js/references_table.js')}}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
@endsection

@section('content')

    <div id="references-table-page">
    <div class="panel-body container-fluid">
        @include('common.errors')
        <div class="panel panel-default">
            <div class="panel-heading">
            {{trans('tables.references_table_header')}}
             <a class="button" href="{{route('editor',['id' =>$id])}}">{{trans('reports.load-report')}}</a>
            </div>
            <div class="panel-body">
    <table id="references-table" class="table centered-cells-table table-striped cell-border">
        <thead>
        <tr>
            <th>{{trans('common.category')}}</th>

            <th>{{trans('common.header')}}</th>

            <th class="centered-cells-table">{{trans('common.image')}}</th>

            <th>{{trans('common.url')}}</th>
        </tr>
         </thead>

        @foreach($references as $reference)
           <tr>
               <td>{{$reference->getCategory()}}</td>

               <td>{{$reference->getHeader()}}</td>

               <td>

                   <div data-toggle="modal" data-url="{{$reference->getImageUrl()}}">

            </div>

               </td>

               <td>
                   <div>
                       <a target="_blank" href="{{$reference->getReferenceUrl()}}">{{$reference->getReferenceUrl()}}</a>
                   </div>
               </td>
           </tr>
        @endforeach
    </table>
</div>
</div>
</div>
    <!-- Modal -->
    <div id="image-preview" class="modal fade" role="dialog" data-keyboard="false" style="text-align: center">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <iframe src="" width="100%" scrolling="no" height="1000px"  type='application/pdf'></iframe>
                </div>
                <div class="modal-footer">
                    <button  type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.close')}}</button>
                </div>
            </div>

        </div>
    </div>
</div>


    @endsection