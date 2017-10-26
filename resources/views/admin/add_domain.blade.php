<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')
@section('styles')
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>
    @endsection
@section('content')
    @section('scripts')
    <script src="{{ asset('js/domains_controll.js') }}"></script>
    @endsection
<div class="panel-body">
    <!-- Display Validation Errors -->
    @include('common.errors')
        <div class="panel panel-default">
            <div class="panel-heading">
               {{trans('tables.google_restricted_domains_table_header')}}
            </div>
            <div class="panel-body">
                <table class="table centered-cells-table table-striped task-table">
                    @if (count($domains) > 0)
                    <!-- Table Headings -->
                    <thead>
                    <tr>
                        <th>{{trans('tables.domain')}}</th>
                        <th>{{trans('common.delete')}}</th>
                        <th>{{trans('common.add')}}</th>
                        <th>{{trans('common.edit')}}</th>
                    </tr>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($domains as $domain)
                        <tr>
                            <td class="table-text">
                        <form method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                    <input name="domain" disabled value="{{ $domain->getDomain() }}" >
                                    <input type="hidden" name="id" value="{{$domain->getId()}}">
                                    <input name="description" placeholder="הערות" disabled value="{{ $domain->getDescription() }}" >
                                    <button type="submit" data-url="" class="btn btn-default send-btn" style="display: none">שלח</button>
                        </form>
                            </td>
                            <td>
                                <i class="fa fa-trash remove-row" aria-hidden="true"></i>
                            </td>
                            <td>
                                <i class="fa fa-plus-circle add-row" aria-hidden="true"></i>
                            </td>
                            <td>
                                <i class="fa fa-pencil edit-row" aria-hidden="true"></i>
                            </td>
                        </tr>
                    @endforeach

                    @else
                        <th>{{trans('tables.domain')}}</th>
                        <th>{{trans('common.delete')}}</th>
                        <th>{{trans('common.add')}}</th>
                        <th>{{trans('common.edit')}}</th>
                        <tr>
                            <td>
                                <form method="post">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                    <input name="domain"  value="" >
                                    <input name="description" placeholder="הערות" value="" >
                                    <button type="submit" data-url="{{route('adddomain')}}" class="btn btn-default send-btn">{{trans('common.send')}}</button>
                                </form>
                            </td>
                            <td>
                                <i class="fa fa-trash remove-row" style="display: none" aria-hidden="true"></i>
                            </td>
                            <td>
                                <i class="fa fa-plus-circle add-row" aria-hidden="true"></i>
                            </td>
                            <td>
                                <i class="fa fa-pencil edit-row" style="display: none" aria-hidden="true"></i>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection