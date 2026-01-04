@if(round($value->rating) == 0)
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($value->rating) == 1)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($value->rating) == 2)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($value->rating) == 3)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($value->rating) == 4)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
@else
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
@endif
{{round($value->rating,2)}} - ({{$value->jumlahvote}} Voter)