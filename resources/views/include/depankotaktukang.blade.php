 <div class="box">
    <img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive"/>
</div>
<div class="info">
    <h4><b>Nama Tukang:</b> {{$value->namatukang}}</h4>
    <h5><b>Kategori:</b> {{$value->kategoritukang}}</h5>
    <h5><b>Rating:</b>
        @include('include/bintang2');
    </h5>
</div>
@if(!Auth::guest())
<a href="{{url('caritukang')}}/{{$value->id_tukang}}/rincianbiaya" class="btn btn-primary" style="width:100%">Lihat Selengkapnya</a>
@endif