<div class="row strech subsection_block">
    <div class="col-xs-2 subsection_label_block">
        @if(isset($labeleditable))
            <span contenteditable="true" class="user-input">{{$label}}</span>
        @else
            <span>{{$label}}</span>
            @endif
    </div>
    <div class="col-xs-10 no-padding sortable">
        @yield("subsection_fields")
    </div>
</div>