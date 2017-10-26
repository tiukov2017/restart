@extends('layouts.table_layout')

@section('addHeader')

    <span>{{trans('user.add')}}</span>

@endsection

@section('form')
        <!-- Create User Form -->
    <form class="form-horizontal" id="add-form" style="display: none" >
        {!! csrf_field() !!}
         <!-- User Name -->
        <div class="form-group">
            <label for="user-name" class="col-sm-3 control-label">{{ trans('user.name') }}</label>
            <div class="col-sm-6">
                <input type="text" required  name="name" id="user-name" class="form-control">
            </div>
        </div>
        <!-- User Role -->
        <div class="form-group">
            <label for="user-role" class="col-sm-3 control-label">{{ trans('user.role-group') }}</label>
            <div class="col-sm-6">
            <select name="role" class="form-control">
                <option value="admin">{{trans('user.admin')}}</option>
                <option value="worker">{{trans('user.worker')}}</option>
                </select>
            </div>
        </div>
        <!-- User Email -->
        <div class="form-group">
            <label for="user-email" class="col-sm-3 control-label">{{ trans('user.email') }}</label>
            <div class="col-sm-6">
                <input type="text" required name="email" id="user-email" class="form-control">
            </div>
        </div>
        <!-- User Phone -->
        <div class="form-group">
            <label for="user-phone" class="col-sm-3 control-label">{{ trans('user.phone') }}</label>
            <div class="col-sm-6">
                <input type="text" required name="user-phone" id="user-phone" class="form-control">
            </div>
        </div>
        <!-- User Status -->
        <div class="form-group">
            <label for="user-status" class="col-sm-3 control-label">{{ trans('user.status') }}</label>
            <div class="col-sm-6">
                <select name="user-status" class="form-control">
                    <option value="active" >{{trans('user.active')}}</option>
                    <option value="suspended" >{{trans('user.suspended')}}</option>
                </select>
            </div>
        </div>
        <!-- Add User Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button id="add-button" class="btn btn-default">
                    <i class="fa fa-plus"></i> {{ trans('user.add') }}
                </button>
            </div>
        </div>
    </form>


   <div id="update-area"  style="display: none">
    <div class="panel panel-default">
        <div class="panel-heading">
            <span class="glyphicon glyphicon-minus-sign"  data-form="#update-form" ></span>
           <span>{{trans('tables.user_manager_table_header')}}</span>
        </div>
    </div>
       <!-- Update User Form -->
    <form id="update-form" method="post" class="form-horizontal" action="{{route('updateUser')}}">
        {!! csrf_field() !!}

         <input type="hidden" id="id" val="" name="id" />
        <!-- User Name -->
        <div class="form-group">
            <label for="user-name" class="col-sm-3 control-label">{{ trans('user.name') }}</label>
            <div class="col-sm-6">
                <input type="text" required  name="name" id="update-user-name" class="form-control">
            </div>
        </div>
        <!-- User Role -->
        <div class="form-group">
            <label for="user-role" class="col-sm-3 control-label">{{ trans('user.role-group') }}</label>
            <div class="col-sm-6">
                <select name="role" class="form-control">
                    <option value="admin" >{{trans('user.admin')}}</option>
                    <option value="worker" >{{trans('user.worker')}}</option>
                </select>
            </div>
        </div>
        <!-- User Phone -->
        <div class="form-group">
            <label for="user-phone" class="col-sm-3 control-label">{{ trans('user.phone') }}</label>
            <div class="col-sm-6">
                <input type="text"  name="user-phone" id="update-user-phone" class="form-control">
            </div>
        </div>
        <!-- User Email -->
        <div class="form-group">
            <label for="user-email" class="col-sm-3 control-label">{{ trans('user.email') }}</label>
            <div class="col-sm-6">
                <input type="text"  name="email" id="update-user-email" class="form-control">
            </div>
        </div>
        <!-- User Status -->
        <div class="form-group">
            <label for="user-status" class="col-sm-3 control-label">{{ trans('user.status') }}</label>
            <div class="col-sm-6">
                <select name="user-status" id="update-user-status" class="form-control">
                    <option value="active" >{{trans('user.active')}}</option>
                    <option value="suspended" >{{trans('user.suspended')}}</option>
                </select>
            </div>
        </div>
        <!-- Update Button -->
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                <button id="update-button" type="submit" formmethod="post" class="btn btn-default">
                    <i class="fa fa-plus"></i> {{ trans('common.confirm') }}
                </button>
            </div>
        </div>
    </form>
   </div>
@endsection
@section('table')
        <!-- Users Table -->
    <div class="panel panel-default">
            <div class="panel-heading">
                {{ trans('user.users-management') }}
            </div>
            <div class="panel-body">
                <table class="table table-striped task-table data-table"  id="users-table">
                    <!-- Table Headings -->
                    <thead>
                    <th>{{ trans('user.name') }}</th>
                    <th>{{ trans('user.role-group') }}</th>
                    <th>{{ trans('user.email') }}</th>
                    <th>{{ trans('user.phone') }}</th>
                    <th>{{ trans('user.status') }}</th>
                    </thead>
                    <!-- Table Body -->
                    <tbody>
                    @foreach ($users as $user)
                            <tr class="user-row">
                                <!-- User Name -->
                            <td class="table-text">
                                <div data-prop="user-name">
                                    {{$user->name}}
                                </div>
                            </td>
                                <!-- User Role -->
                            <td class="table-text">
                                <div data-prop="user-role">{{ trans('user.'.$user->getRole()) }}</div>
                            </td>
                                <!-- User Email -->
                            <td class="table-text">
                                <div data-prop="user-email">
                                    {{$user->email}}
                                </div>
                              </td>
                                <!-- User Phone -->
                            <td class="table-text">
                                <div data-prop="user-phone">{{ $user->phone  }}</div>
                            </td>
                                <!-- User Id -->
                            <td class="table-text" >
                                <div  data-prop="user-status" data-filter="status">{{ trans('user.'.$user->status)  }}</div>
                                <input type="hidden" data-prop="user-id" value="{{$user->id}}">
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
@endsection

@section('table_scripts')
    <script src="{{asset('js/users_table.js')}}"></script>

@endsection