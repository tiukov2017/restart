<div class="dropdown" id={{$id}}>
    <div>
        <button class="btn btn-default" type="button" data-toggle="dropdown">
                <i class="fa fa-bookmark-o add-bookmark"  aria-hidden="true" data-title="הוסף לרשימת עיון" data-placement="bottom"></i>
            {{$header}}
            <span class="caret dropdown-toggle"></span>
        </button>
        <div class="add-bookmark-form">
               <input type="text" id="add-bookmark-title">
               <input type="button" class="btn btn-default" id="add-bookmark-btn" value="הוסף"/>
        </div>
        <ul class="dropdown-menu bookmarks-dropdown">
            @foreach($contentList as $listItem)
            <li>
                <i class="fa fa-trash remove-bookmark" data-id="{{$listItem->getId()}}" aria-hidden="true"></i>
                <a data-toggle="tooltip" title="{{$listItem->getTitle()}}" href="{{$listItem->getUrl()}}" target="google-results-iframe">{{$listItem->getTitle()}}</a>
            </li>
            @endforeach
        </ul>
    </div>

</div>