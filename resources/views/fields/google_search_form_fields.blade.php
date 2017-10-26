
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="srcArr" id='srcArr' value="{{$srcArr}}"/>
<input type="hidden" name="resultCount" id='resultCount' value="{{$resultCount}}"/>
<input type="hidden" name="queriesArr" id="queriesArr" value="{{$queriesArr}}"/>
<input type="hidden" name="currentQueryIndex" id="currentQueryIndex" value="{{$currentQueryIndex}}"/>
<input type="hidden" name="startIndex" id="startIndex" value="{{$startIndex}}"/>
<input type="hidden" name="isNewQuery" id="isNewQuery" value={{$isNewQuery}} />