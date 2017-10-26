<!-- Modal -->
<div id="{{$id}}" class="modal view-mode-invisible fade" role="dialog" data-keyboard="false" data-backdrop="static" style="text-align: center">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{$title}}</h4>
            </div>
            <div class="modal-body">
              @yield('modal-body')
            </div>
            <div class="modal-footer">
                <button id="{{$acceptAction}}" type="button" class="btn btn-default" data-dismiss="modal" {{isset($attributes)?$attributes : ''}}>המשך</button>
                <button id="{{$cancelAction}}" type="button" class="btn btn-default" data-dismiss="modal">בטל</button>
            </div>
        </div>

    </div>
</div>