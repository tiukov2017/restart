<section class="containerSection row" status="" id="section_{{$id}}" section-id="{{$id}}">
    <header class="col-xs-12 no-padding">
    <div class="section_header">
        <img src="{{$icon}}" alt="אייקון משתמש">
        <h2>
            {{$title}}
        </h2>
        </div>
        <div class="more_info">
            <img src="{{asset('assets/images/more_info.png')}}" alt="אייקון מידע נוסף"
                 data-target="moreDetails_{{$id}}" data-toggle="collapse"
                 data-toggle="tooltip"
                 data-placement="bottom",
                 data-html="true"
                 data-title="{{$desc}}" class="status-hover"/>
        </div>
        <div class="col-xs-12  collapse  header" id="moreDetails_{{$id}}">
            <textarea>

            </textarea>
</div>
    </header>
    <div class="col-xs-12">
        @yield('section_content')
    </div>
</section>
