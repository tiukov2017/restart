@extends('popup_layout')

@section('modal-body')

    <form  enctype="multipart/form-data" method="post">

        <div class="form-group">
            <label for="edit-file-name" class="col-sm-3 control-label">{{ trans('reports.file-name') }}</label>
            <input type="text" class="form-control" name="edit-file-name" id="edit-file-name"  />


            <label for="edit-file-description" class="col-sm-3 control-label">{{ trans('reports.file-description') }}</label>
            <input type="text" class="form-control" id="edit-file-description"  />

        </div>

    </form>
@overwrite