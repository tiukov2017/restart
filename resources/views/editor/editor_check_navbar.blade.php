<div>
    <div class="size-contorls">
        <i class="fa fa-expand expand" aria-hidden="true"></i>
        <i class="fa fa-compress compress"  aria-hidden="true"></i>
    </div>

    <ol class ="list-group nav-pills">
        @foreach($checkList as $check)
            {{-- Check if the object is GoogleCheck entity and if it's set custom url, otherwise set regular url --}}
            @if($check instanceof App\Entities\GoogleCheck)
                @if($_SERVER['HTTP_HOST'] == '54.209.209.56' || $_SERVER['HTTP_HOST'] == '54.173.137.213' || $_SERVER['HTTP_HOST'] == 'localhost')
                    <li class="list-group-item checklist-btn" data-guidelines ="{{$check->getGuidelines()}}"
                        data-input-fields="{{!is_null($check->getInputFields())?$check->getInputFields() : ''}}"
                        data-check-name="{{$check->getCheckName()}}"
                        data-url="/checknet/public/{{ $check->getUrl() }}{{ $id }}/google/{{ $check->getCheckNumber() }}"
                        data-number="{{$check->getCheckNumber()}}"
                        data-field="{{$check->getField()}}" title="{{$check->getCheckName()}}" data-toggle="tooltip">
                        {{$check->getCheckNumber()}}
                    </li>
                @else
                    <li class="list-group-item checklist-btn" data-guidelines ="{{$check->getGuidelines()}}"
                        data-input-fields="{{!is_null($check->getInputFields())?$check->getInputFields() : ''}}"
                        data-check-name="{{$check->getCheckName()}}"
                        data-url="/{{ $check->getUrl() }}{{ $id }}/google/{{ $check->getCheckNumber() }}"
                        data-number="{{$check->getCheckNumber()}}"
                        data-field="{{$check->getField()}}" title="{{$check->getCheckName()}}" data-toggle="tooltip">
                        {{$check->getCheckNumber()}}
                    </li>
                @endif
            @else
                <li class="list-group-item checklist-btn" data-guidelines ="{{$check->getGuidelines()}}"
                    data-input-fields="{{!is_null($check->getInputFields())?$check->getInputFields() : ''}}"
                    data-check-name="{{$check->getCheckName()}}"
                    data-url="{{$check->getUrl()}}"
                    data-number="{{$check->getCheckNumber()}}"
                    data-field="{{$check->getField()}}" title="{{$check->getCheckName()}}" data-toggle="tooltip">
                    {{$check->getCheckNumber()}}
                </li>
            @endif
         @endforeach

        <div class="reference-buttons">
            <button class="btn btn-default" id="view-references">{{trans('editor.references')}}</button>
            <button class="btn btn-default" id="view-order">{{trans('editor.order')}}</button>
            <button class="btn btn-default" id="filtered-results-table">{{trans('google.filtered_results')}}</button>
        </div>
    </ol>
</div>