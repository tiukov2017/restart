<section class="expandable_title_fieldblock">
<div class="row">
    <header class="col-xs-12">

        <div class="row strech">

            <div class="col-xs-9">
                <img  class="socialTitleIcon replaceAbleImage img-circle" src="{{asset('assets/images/social_icon.png')}}">
                    <img class="social-small-icon replaceAbleImage" src="{{$social_icon}}" alt="סושיאל אייקון"/>
                <p contenteditable="true" class="user-input" id="{{$id}}_social-title"  {{isset($attributes) ? $attributes : ''}}>&nbsp;</p>
            </div>

            <div class="col-xs-4 social-container">
                @include('fields.status_icon',['id'=>$id])
                @include('fields.expand_button',['id' => $id])
                @if(isset($clonable))
                    <div class="plusMinusButtons">
                        @include('fields.add_remove_buttons',['target'=>'.expandable_title_fieldblock','scroll'=>true])
                    </div>
                @endif
            </div>

        </div>
    </header>
    </div>
<div class="row">
    <div class="col-xs-12 no-padding collapseAbleFieldBlock collapse in" id="{{$id}}">
        @yield('collapse_fields')
    </div>
    </div>
</section>