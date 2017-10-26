@extends('layouts.app')
@section('scripts')

@endsection
@section('styles')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
@endsection
@section('content')

    <div class="panel panel-danger" style="text-align:center">
        <div class="panel-heading">{{trans('reports.unavialableMessage')}}
               <div>
                   <a href="{{route('home')}}">
                    {{trans('common.back')}}
                   </a>
               </div>
        </div>
    </div>
@endsection