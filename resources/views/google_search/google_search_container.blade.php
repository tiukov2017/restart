@extends('layouts.goolge_iframes_layout')
@section('content')
<div id="google-form-container">
    @include('google_search.google_search_subsection',['ids'=>$ids,'paramsArr'=>explode(",", $paramsArr),'templates'=>explode(",", $templates)])
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/google_search.js') }}"></script>
@endsection