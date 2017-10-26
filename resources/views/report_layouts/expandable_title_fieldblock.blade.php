<section class="expandable_title_fieldblock">
<div class="row">
    <header class="col-xs-12">

        <div class="row strech">

            <div class="col-xs-9 title_container">
                <input type="text" class="titleInput user-input" name="{{$id}}_title"
                       id="{{$id}}_title"
                       {{isset($attributes) ? $attributes : ''}}
                       double-check="true"/>
            </div>
            <div class="col-xs-3">
                    @include('fields.status_icon',['id'=>$id.'_title'])
                @include('fields.expand_button',['id' => $id,'scroll'=>'true'])
                <div class="plusMinusButtons">
                    @include('fields.add_remove_buttons',['target'=>'.expandable_title_fieldblock','scroll'=>true])
                </div>
            </div>
        </div>
    </header>
    </div>
<div class="row">
    <div class="col-xs-12 collapseAbleFieldBlock collapse {{isset($containerClasses)?$containerClasses:''}}" id="{{$id}}">
        @yield('collapse_fields')
    </div>
    </div>
</section>