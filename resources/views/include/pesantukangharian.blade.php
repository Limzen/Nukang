<div id="vendorboard" data-backdrop="static" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{url('caritukang')}}/{{$tukang->id_tukang}}/pesan" style="padding-top:50px;padding-bottom:50px">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="modal-content">
                <div class="modal-body" style="text-align:left">
                    <div class="row">
                        <center>
                            <p>NB: Jam Kerja Aplikasi Hanya Diberlakukan Dari Jam 07:00 Hingga 23:00.. Lewat Jam Tersebut Team Cari Tukang Tidak Bertanggung Jawab Atas Segala Tindak Kejahatan Yang Terjadi</p>
                        </center>
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6">
                            <div class="borderkotak tengah">
                                <h4>Saldo Elektronik Anda Rp. {{number_format(Auth::user()->saldo,2)}}</h4>
                            </div>
                            <div class="row" style="padding-top:10px">
                                <center>
                                    <img src="{{ asset('images/fotoprofil') }}/{{$tukang->fotoprofil}}" class="img-responsive" style="border:1px solid black" width="160" height="160"> 
                                    <h3><b>{{$tukang->kodeuser}}</b></h3>
                                    <h4>{{$tukang->namatukang}}</h4>
                                    <h4>{{$tukang->alamat}}</h4>
                                    <h5><b>Rating:</b>
                                     @include('include/bintang')
                                    </h5>
                                    <h4>Kategori: {{$tukang->kategoritukang}}</h4>
                                </center>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                    <div class="row" style="padding:10px;padding-top:20px;">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Jenis Pemesanan</b></label>
                            <div class="col-md-6" style="padding-top:5px">
                                <div class="col-md-3">
                                    <input type="radio" name="jenis" id="jenis" value="0" checked> Harian 
                                </div>
                                <div class="col-md-4">
                                    <input type="radio" name="jenis" id="jenis" value="1"> Borongan
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="harian">
                            <label class="col-md-4 control-label"><b>Pilih Jasa Yang Ingin Dipakai</b></label>
                            <div class="col-md-6">
                               <select class="form-control" name="jenispemesanan">
                                    @foreach($jasatersediaharian as $key => $value)
                                    <option value="{{$value->id_jenispemesanan}},{{$value->biayajasatersedia}}">{{$value->jenispemesanan}} - (Rp. {{number_format($value->biayajasatersedia,2)}})</h4>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                         <div class="form-group" id="borongan" style="display:none">
                            <label class="col-md-4 control-label"><b>Pilih Jasa Yang Ingin Dipakai</b></label>
                            <div class="col-md-6">
                               <select class="form-control" name="jenispemesanan2">
                                    @foreach($jasatersediaborongan as $key => $value)
                                    <option value="{{$value->id_jenispemesanan}},{{$value->biayajasatersedia}}">{{$value->jenispemesanan}} - (Rp. {{number_format($value->biayajasatersedia,2)}})</h4>
                                    @endforeach
                               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Alamat Pelanggan</b></label>
                            <div class="col-md-6">
                                @if(count($alamatpelanggan) != 0)
                                <select class="form-control" name="alamatpemesanan">
                                    @foreach($alamatpelanggan as $key => $value)
                                    <option value="{{$value->alamatpelanggan}},{{$value->latitudealamat}},{{$value->longtitudealamat}}">{{$value->alamatpelanggan}}</h4>
                                    @endforeach 
                                </select>
                                <h5>Anda Ingin Menambahkan Alamat Lain? Silahkan <a href="{{url('tambahalamat')}}" target="_blank">Tambah Alamat</a></h5>
                                @else
                                <h5>Belum Memiliki Alamat Silahkan <a href="{{url('tambahalamat')}}">Tambah Alamat</a> Terlebih Dahulu</h5>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Tanggal Penyedia Jasa Renovasi Bekerja</b></label>
                            <div class="col-md-6">
                               <input type="date" class="form-control" name="tanggalbekerja" min="{{date('Y-m-d',strtotime('+1 days'))}}" required>
                            </div>
                        </div>
                         <div class="form-group" id="tanggalselesai" style="display:none">
                            <label class="col-md-4 control-label"><b>Tanggal Selesai Bekerja</b></label>
                            <div class="col-md-6">
                               <input type="date" class="form-control" name="tanggalselesai" id="tanggalselesaitype" min="{{date('Y-m-d',strtotime('+1 days'))}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Catatan</b></label>
                            <div class="col-md-6">
                               <textarea class="form-control" name="catatan" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label"><b>Upload Foto Kondisi / Kerusakan (OPTIONAL)</b></label>
                            <div class="col-md-6" style="margin-left:-15px">
                                <div class="col-sm-2" style="margin-right:20px;width:100px">
                                    <div class="top-right">
                                        <i class="fa fa-times" id="close1" style="display:none"></i>
                                    </div>
                                    <div id="imagePreview1" style="background-image:url('../../images/frontslider/addpicture.png')"></div>
                                    <input id="uploadFile1" style="color:transparent" type="file" name="foto1" class="img">
                                </div>
                                <div class="col-sm-2" style="margin-right:20px;width:100px">
                                    <div class="top-right">
                                        <i class="fa fa-times" id="close2" style="display:none"></i></a>
                                    </div>
                                    <div id="imagePreview2" style="background-image:url('../../images/frontslider/addpicture.png')"></div>
                                    <input id="uploadFile2" style="color:transparent" type="file" name="foto2" class="img">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" aria-label="Close" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary" id="proses">Pesan</button>
                </div>
            </div>
        </form>
    </div>
</div>