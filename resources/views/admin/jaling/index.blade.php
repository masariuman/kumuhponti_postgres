@extends('layouts.admin.main')

@section('seo-title')
Wilayah Kumuh
@endsection

@section('title')
<span class="gi gi-compass"></span> Wilayah Kumuh
@endsection

@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endpush

@section('main')

<!-- Get Started Block -->
<div class="block full">
        <!-- Get Started Content -->
            <!-- Datatables Block -->
                        <!-- Datatables is initialized in js/pages/uiTables.js -->
                        <div class="block full">
                            <div class="block-title">
                                <h2>Tabel Wilayah Kumuh</h2>
                                <div class="pull-right" style="margin-top: 10px;margin-right: 10px;">
                                    <label>Selesai : {{ $datas->where('data','!=',null)->count() }}</label> / 
                                    <label>Belum : {{ $datas->where('data',null)->count() }}</label>
                                </div>
                            </div>

                            @if(session()->get('message')=="sukses")
                            <!-- Success Alert -->
                                    <div class="alert alert-success alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong><i class="hi hi-check"></i> Sukses</strong></h4>
                                        <p>Data Pada Aplikasi Sudah Berubah!</p>
                                    </div>
                            <!-- END Success Alert -->
                            {{session()->forget('message')}}
                            @endif
                            @if(session()->get('message')=="info")
                             <!-- Info Alert -->
                                    <div class="alert alert-info alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong>Information</strong></h4>
                                        <p>Just an information <a href="javascript:void(0)" class="alert-link">message</a>!</p>
                                    </div>
                                    <!-- END Info Alert -->
                            {{session()->forget('message')}}
                            @endif
                            @if(session()->get('message')=="error")
                            <!-- Danger Alert -->
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong>Error</strong></h4>
                                        <p>{{session()->get('error')}}</p>
                                    </div>
                                    <!-- END Danger Alert -->
                            {{session()->forget('message')}}
                            @endif
                            @if(session()->get('message')=="gagalimport")
                            <!-- Danger Alert -->
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong>Terjadi Kesalahan Pada Saat Menambah Data</strong></h4>
                                        <p>Format Data pada File Excel Anda Salah Atau Tidak Sesuai Dengan Format Yang Disediakan Atau Terdapat Data yang Kosong pada File Excel</p>
                                    </div>
                                    <!-- END Danger Alert -->
                            {{session()->forget('message')}}
                            @endif
                            @if(session()->get('message')=="gagalimportkosong")
                            <!-- Danger Alert -->
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong>Terjadi Kesalahan Pada Saat Menambah Data</strong></h4>
                                        <p>Terdapat Data yang Kosong pada File Excel</p>
                                    </div>
                                    <!-- END Danger Alert -->
                            {{session()->forget('message')}}
                            @endif


                            <!-- <a href="{{Request::URL()}}/create" class="btn btn-effect-ripple btn-success"> <i class="fa fa-plus"></i> Tambah Data</a> -->
                            <div class="row">
                                <div class="col-md-6">
                                  <button data-toggle="modal" data-target="#import" class="btn btn-effect-ripple btn-success" style="float: left;"  > <i class="fa fa-file"></i> Import Data</button> 
                                  <form method="POST" enctype="multipart/form-data" action="{{ route('jaling.export') }}">
                                    {{ csrf_field() }}
                                    <button data-toggle="modal" data-target="#export" class="btn btn-effect-ripple btn-primary" style="margin-left: 5px;"> <i class="fa fa-file"></i> Export Data</button> 
                                  </form>
                                  <!-- <a href="{{ route('jaling.show_all') }}" class="btn btn-effect-ripple btn-primary"> <i class="fa fa-map"></i> Peta Data</a>  -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Kecamatan</label>
                                        <select class="form-control" id="kecamatan">
                                            <option selected="" disabled="" value="">Pilih</option>
                                            <option value="all">Semua Data</option>
                                            @foreach($kecamatan as $key => $value)
                                                @if($key != '')
                                                    <option value="{{ $key }}"
                                                        @if( isset($_GET['kecamatan']) )
                                                            {{ ($_GET['kecamatan'] == $key) ? 'selected="true"' : '' }}
                                                        @endif
                                                    >{{ $key }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="padding-top: 10px;">
                                <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 30px;">No.</th>
                                            <th class="text-center" style="width: 75px;">Data Gambar</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center">Kecamatan</th>
                                            <th class="text-center">Kelurahan</th>
                                            <th class="text-center">Luas</th>
                                            <th class="text-center">Status</th> 
                                            <th class="text-center" style="width: 90px;"><i class="fa fa-flash"></i> Aksi</th>
                                            <th class="text-center">Last Updated by</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $no => $data)
                                            <tr>
                                                <td class="text-center">{{$no+1}}</td>
                                                <td class="text-center">{!! ( empty($data->data) ) ? '<span class="fa fa-close" style="color: red;"></span>' : '<span class="fa fa-check" style="color: green;"></span>' !!}</td>
                                                <td>{{$data->nama_lokasi}}</td>
                                                <td class="text-center">{{$data->kecamatan}}</td>
                                                <td class="text-center">{{$data->lokasi_keg}}</td>
                                                <td class="text-center">{{$data->luas}}</td>
                                                <td class="text-center">{{$data->rencana}}</td>
                                                <td class="text-center">
                                                <!-- <a href="{{Request::URL().'/'.$data->id}}" data-toggle="tooltip" title="Detail Data" class="btn btn-effect-ripple btn-sm btn-info"><i class="gi gi-circle_info"></i></a> -->
                                                <a href="javascript:modalUbah({{$data->id}})" data-toggle="tooltip" title="Ubah Data" class="btn btn-effect-ripple btn-sm btn-success"><i class="fa fa-pencil"></i></a>

                                                <a href="{{Request::URL().'/'.$data->id}}" data-toggle="tooltip" title="Gambar Data" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-map"></i></a>

                                                <a href="javascript:modalHapus({{$data->id}})" data-toggle="tooltip" title="Hapus Data" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                                <!-- <a
                                                    onclick="event.preventDefault();
                                                             document.getElementById('hapus-form-{{$data->id}}').submit();"
                                                    data-toggle="tooltip" title="Hapus Data" class="btn btn-effect-ripple btn-sm btn-danger"
                                                >
                                                    <i class="fa fa-times"></i>
                                                </a> -->

                                                    <form id="hapus-form-{{$data->id}}" action="{{ Request::URL().'/'.$data->id }}" method="POST" style="display: none;">
                                                        {{ csrf_field() }}
                                                        {{ method_field('DELETE') }}
                                                    </form>
                                                </td> 
                                                <td class="text-center">{{$data->user->name}}<br/><a href="javascript:modalHistory({{$data->id}})" data-toggle="tooltip" title="Cek History">Cek History</a></td>                                             
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END Datatables Block -->
        <!-- END Get Started Content -->
</div>
<!-- END Get Started Block -->
<div id="modal"></div>  
<!-- tambah -->
<div id="import" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: aqua; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Import Data</strong></h3>
            </div>
            <form method="POST" enctype="multipart/form-data" action="{{ route('jaling.import') }}">
                {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" value="{!! Auth::user()->id !!}" name="user_id" />
                    <label>Data Excel</label>
                    <input type="file" name="data" accept=".xls,.xlsx,.csv" required="" class="form-control">
                </div>
                <div class="form-group">
                    <label>Contoh Format Isi File EXCEL</label>
                    <center><img src="/img/excel.JPG" alt="FORMAT ISI EXCEL" class="img-responsive"></center>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-effect-ripple btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- END tambah -->
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">

    var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                    columnDefs: [ { orderable: false, targets: [7], searchable:false } ],
                    "lengthMenu": [[-1, 10, 25, 50], ["Semua", 10, 25, 50]],
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                        "sEmptyTable": "Tidak ada data di database"
                    }
                });
            }
        };
    }();

</script>

<script>
    $(function () {

        UiTables.init();

        $('#kecamatan').change(function(){
            var url = '{{ Request::URL() }}';
            if ( $(this).val() != 'all' ) {
                url += '?kecamatan='+$(this).val();
            }
            $(location).attr('href',url);
        });

        $('select').select2();
    });
</script>

<script>

     //modal ubah
    function modalUbah(id) {
                $.ajax({
                  type:"GET",
                  url:"/api/cari-kumuh/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#5ccdde; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Ubah Wilayah Kumuh</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body">'+
                                                                                '<form method="post" name="valid" class="form-bordered" onsubmit="return validasiubah()">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="PUT">'+
                                                                                '<input type="hidden" name="id" value="'+hasil['id']+'">'+
                                                                                '<input type="hidden" name="luas" value="'+hasil['luas']+'">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Lokasi</label>'+
                                                                                        '<input class="form-control" name="nama_lokasi" type="text" value="'+hasil['nama_lokasi']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Kecamatan</label>'+
                                                                                        '<input class="form-control" name="kecamatan" type="text" value="'+hasil['kecamatan']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Keluharan</label>'+
                                                                                        '<input class="form-control" name="lokasi_keg" type="text" value="'+hasil['lokasi_keg']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Status</label>'+
                                                                                        '<input class="form-control" name="rencana" type="text" value="'+hasil['rencana']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Catatan</label>'+
                                                                                        '<textarea class="form-control" name="catatan"></textarea>'+
                                                                                    '</div>'+
                                                                                    '<input type="hidden" value="{!! Auth::user()->id !!}" name="user_id" />'+

                                                                                    
                                                                                    '<div class="modal-footer">'+
                                                                                        '<button type="submit" class="btn btn-effect-ripple btn-primary">Simpan</button>'+
                                                                                        '</form>'+
                                                                                        '<button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Tutup</button>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                      '</div>'+
                                                                    '</div>';
                    $('#modal').show();
                    $('#myModal').modal('show');
                  },
                  error: function(e) {
                    console.log(e);
                  }
                });
    }

        //modal hapus
    function modalHapus(id) {
                $.ajax({
                  type:"GET",
                  url:"/api/cari-kumuh/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#de815c; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Hapus Wilayah Kumuh</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body" align="center" style="color:red;">'+
                                                                          '<h3><strong>Apakah kamu yakin akan menghapus data </strong></h3>'+
                                    '<table>'+
                                    '    <tr>'+
                                    '        <td>'+
                                    '            Lokasi'+
                                    '        </td>'+
                                    '        <td style="padding-left: 10px; padding-right: 10px;">'+
                                    '            :'+
                                    '        </td>'+
                                    '        <td>'+
                                    '            '+hasil['nama_lokasi']+''+
                                    '        </td>'+
                                    '    </tr>'+
                                    '    <tr>'+
                                    '        <td>'+
                                    '            Kecamatan'+
                                    '        </td>'+
                                    '        <td style="padding-left: 10px; padding-right: 10px;">'+
                                    '            :'+
                                    '        </td>'+
                                    '        <td>'+
                                    '            '+hasil['kecamatan']+''+
                                    '        </td>'+
                                    '    </tr>'+
                                    '   <tr>'+
                                    '      <td>'+
                                    '         Keluharan'+
                                    '      </td>'+
                                    '      <td style="padding-left: 10px; padding-right: 10px;">'+
                                    '         :'+
                                    '      </td>'+
                                    '      <td>'+
                                    '         '+hasil['lokasi_keg']+''+
                                    '      </td>'+
                                    '   </tr>'+
                                    '   <tr>'+
                                    '      <td>'+
                                    '         Status'+
                                    '      </td>'+
                                    '      <td style="padding-left: 10px; padding-right: 10px;">'+
                                    '         :'+
                                    '      </td>'+
                                    '      <td>'+
                                    '        '+hasil['rencana']+''+
                                    '      </td>'+
                                    '   </tr>'+
                                    '</table>'+
                                                                          '</div>'+
                                                                          '<div class="modal-footer">'+
                                                                            '<form method="post" name="validd" onsubmit="return validasihapus()">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="PATCH">'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
                                                                                '<input type="hidden" value="{!! Auth::user()->id !!}" name="user_id" />'+
                                                                                '<div class="form-group">'+
                                                                                        '<label style="float:left;">Catatan</label>'+
                                                                                        '<textarea class="form-control" name="catatan"></textarea>'+
                                                                                    '</div>'+
                                                                                '<button type="submit" class="btn btn-success">OK</button>'+
                                                                                '<button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Batal</button>'+
                                                                            '</form>'+
                                                                          '</div>'+
                                                                        '</div>'+
                                                                      '</div>'+
                                                                    '</div>';
                    $('#modal').show();
                    $('#myModal').modal('show');
                  },
                  error: function(e) {
                    console.log(e);
                  }
                });
    }






    //modal History
    function modalHistory(id) {
                $.ajax({
                  type:"GET",
                  url:"/api/cari-history/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                    var inner = '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#5ccdde; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">5 Pembaharuan Data Terakhir</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body">';
                                                                                 
                    
                    var inner2 ='                                                                                <div class="table-responsive">'+
'        <table id="general-table" class="table table-vcenter table-hover table-condensed table-striped table-borderless">'+
'            <thead>'+
'                <tr>'+
'                    <th class="text-center" style="width: 50px;">No.</th>'+
'                    <th class="text-center" style="width: 300px;">Lokasi</th>'+
'                    <th class="text-center">Kecamatan</th>'+
'                    <th class="text-center">Kelurahan</th>'+
'                    <th class="text-center">Luas</th>'+
'                    <th class="text-center">Oleh</th>'+
'                    <th class="text-center">Jenis Update</th>'+
'                    <th class="text-center" style="width: 130px;">Pembaharuan Terakhir Pada Tanggal</th>'+
'                    <th class="text-center" style="width: 200px;">Catatan Pembaharuan</th>'+
'                </tr>'+
'            </thead>'+
'            <tbody>';

    
var inner3 = '';
var kumuh_id = null;
var no = null;
$.each(JSON.parse(JSON.stringify(hasil)), function(idx, obj) {
    // alert(obj.lokasi);
    no = idx + 1;
    kumuh_id = obj.kumuh_id;
    inner3 = inner3 + '<tr>'+                    
'                                                <td class="text-center">'+no+'</td>'+
'                                                <td>'+obj.lokasi+'</td>'+
'                                                <td class="text-center">'+obj.kecamatan+'</td>'+
'                                                <td class="text-center">'+obj.kelurahan+'</td>'+
'                                                <td class="text-center">'+obj.luas+'</td>'+
'                                                <td class="text-center">'+obj.user_id+'</td>'+
'                                                <td class="text-center">'+obj.kategori_update+'</td>'+
'                                                <td class="text-center">'+obj.created_at+'</td>'+
'                                                <td class="text-center">'+obj.catatan+'</td>'+
'                                                '+
'                                            </tr>';
});
                


var inner4 = '</tbody></table>'+
'                                                                               <form method="post" class="form-bordered" action="kumuh/history/'+id+'" style="margin-bottom: 0px;margin-right: 0px;">'+
'                                                                      <div class="modal-footer">'+

                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
                                                                                        '<button type="submit" class="btn btn-effect-ripple btn-primary">Lihat Lebih Lengkap</button>'+
                                                                                '</form>'+
                                                                                        '<button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Tutup</button>'+
                                                                                    '</div>'+
                                                                            '</div>'+
                                                                        '</div>'+
                                                                      '</div>'+
                                                                    '</div>';






                    document.getElementById("modal").innerHTML = inner + inner2 + inner3 +inner4;
                    $('#modal').show();
                    $('#myModal').modal('show');
                  },
                  error: function(e) {
                    console.log(e);
                  }
                });
    }
</script>
<script>
    function validasiubah() {
        var nama_lokasi = document.forms["valid"]["nama_lokasi"].value;
        var kecamatan   = document.forms["valid"]["kecamatan"].value;
        var lokasi_keg  = document.forms["valid"]["lokasi_keg"].value;
        var rencana     = document.forms["valid"]["rencana"].value;
        var catatan     = document.forms["valid"]["catatan"].value;
        if ( nama_lokasi== "") {
            alert("Lokasi harus diisi");
            return false;
        }
        if ( kecamatan== "") {
            alert("Kecamatan harus diisi");
            return false;
        }
        if ( lokasi_keg== "") {
            alert("Kelurahan harus diisi");
            return false;
        }
        if ( rencana== "") {
            alert("Status harus diisi");
            return false;
        }
        if ( catatan== "") {
            alert("Catatan perubahan harus diisi");
            return false;
        }
    }

    function validasihapus() {
        var catatan     = document.forms["validd"]["catatan"].value;
        if ( catatan== "") {
            alert("Catatan perubahan harus diisi");
            return false;
        }
    }
</script>
@endpush