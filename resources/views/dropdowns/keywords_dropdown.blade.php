<div class="dropdown" id={{$id}}>
   <div>
       <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
       <span class="glyphicon glyphicon-refresh glyphicon-refresh-animate keywords-count"></span>{{$header}}
           <span class="caret"></span><span class="glyphicon glyphicon-repeat repeat-icon"></span></button>
       <ul class="dropdown-menu">
           @foreach($contentList as $listItem)
              <?php
               $query = str_replace('+',' ',$listItem);?>
               @if($query!='""')
                  <li><span class="badge"></span><a htef="#">{{str_replace('"','',$query)}}</a></li>
              @endif
               @endforeach
       </ul>
   </div>
</div>