@if(round($tukang->rating) == 0)
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($tukang->rating) == 1)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($tukang->rating) == 2)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($tukang->rating) == 3)
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star starcolor"></span>
<span class="glyphicon glyphicon-star"></span>
<span class="glyphicon glyphicon-star"></span>
@elseif(round($tukang->rating) == 4)
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
{{round($tukang->rating,2)}} - ({{$tukang->jumlahvote}} Voter)