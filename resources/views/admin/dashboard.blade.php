@extends('layouts.admin.main')

@section('seo-title')
Dashboard
@endsection

@section('title')
<span class="gi gi-compass"></span> DASHBOARD
@endsection

@section('breadcrumbs')
<ul class="breadcrumb breadcrumb-top">
	<li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
</ul>
@endsection

@section('main')

<p></p><p></p>
<div class="row" style="margin-left: 100px; margin-right: 100px;">
	<div class="col-sm-6 col-md-6">
		<a href="javascript:void(0)" class="widget">
			<div class="widget-content widget-content-mini text-right clearfix">
				<div class="widget-icon pull-left themed-background-success">
					<i class="gi gi-log_book text-light-op"></i>
				</div>
				<h2 class="widget-heading h3 text-success">
					<strong><span data-toggle="counter" data-to="2835">{{ $datas->where('data','!=',null)->count() }}</span></strong>
				</h2>
				<span class="text-muted">JUMLAH DATA YANG SUDAH DIGAMBAR</span>
			</div>
		</a>
	</div>
	<div class="col-sm-6 col-md-6">
		<a href="javascript:void(0)" class="widget">
			<div class="widget-content widget-content-mini text-right clearfix">
				<div class="widget-icon pull-left" style="background-color: #de5c5c;">
					<i class="gi gi-warning_sign text-light-op"></i>
				</div>
				<h2 class="widget-heading h3" style="color: #de5c5c;">
					<strong><span data-toggle="counter" data-to="2862">{{ $datas->where('data',null)->count() }}</span></strong>
				</h2>
				<span class="text-muted">JUMLAH DATA YANG BELUM DIGAMBAR</span>
			</div>
		</a>
	</div>
</div>


<div class="block">
	<div class="table-responsive">
		<table id="general-table" class="table table-vcenter table-hover table-condensed table-striped table-borderless">
			<thead>
				<tr>
					<th class="text-center" style="width: 50%;">STATUS</th>
                    <th class="text-center" style="width: 50%;">JUMLAH</th>
				</tr>
			</thead>
			<tbody>
				@foreach($status as $key => $value)
                                            <tr>
                                                <td class="text-center">{{ $key }}</td>
                                                <td class="text-center"><a href="javascript:modalstatus('{{$key}}')" data-toggle="tooltip" title="Cek Data">{{ $value->count() }}</a></td> 
                                                <!-- <td class="text-center"><a href="{{$key}}" data-toggle="tooltip" title="Cek Data">{{ $value->count() }}</a></td>                                                -->
                                            </tr>
                @endforeach
			</tbody>
		</table>
	</div>
</div>


<div class="block">
	<div class="block-title clearfix text-center">
		<h2><span class="hidden-xs">PERBAHARUAN</span> TERAKHIR</h2>
	</div>
	<div class="table-responsive">
		<table id="general-table" class="table table-vcenter table-hover table-condensed table-striped table-borderless">
			<thead>
				<tr>
					<th class="text-center" style="width: 50px;">No.</th>
                    <th class="text-center" style="width: 250px;">Lokasi</th>
                    <th class="text-center">Kecamatan</th>
                    <th class="text-center">Kelurahan</th>
                    <th class="text-center">Luas</th>
                    <th class="text-center" style="width: 100px;">Oleh</th>
                    <th class="text-center" style="width: 130px;">Pembaharuan Terakhir Pada Tanggal</th>
                                            <th class="text-center">Jenis Update</th>
                    <th class="text-center" style="width: 200px;">Catatan Pembaharuan</th>
				</tr>
			</thead>
			<tbody>
				@foreach($history as $no => $data)
                                            <tr>
                                                <td class="text-center">{{$no+1}}</td>
                                                <td>{{$data->lokasi}}</td>
                                                <td class="text-center">{{$data->kecamatan}}</td>
                                                <td class="text-center">{{$data->kelurahan}}</td>
                                                <td class="text-center">{{$data->luas}}</td>
                                                <td class="text-center">{{$data->user->name}}<br/><a href="javascript:modalHistory({{$data->kumuh_id}})" data-toggle="tooltip" title="Cek History">Cek History</a></td>
                                                <td class="text-center">{{date('d F Y', strtotime($data->created_at))}}</td>
                                                <td class="text-center">{{$data->kategori_update}}</td>
                                                <td class="text-center">{{$data->catatan}}</td>
                                                
                                            </tr>
                                        @endforeach
			</tbody>
		</table>
	</div>
</div>
<div id="modal"></div>







<script>
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
	//modal History
    function modalstatus(stats) {
                $.ajax({
                  type:"GET",
                  url:"/api/cari-status/"+stats,
                  dataType: 'json',
                  success: function(hasil){
                  	// alert('a');
                  	
                    $('#modal').empty();
                    
var inner = '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#5ccdde; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Info Data</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body">';
                                                                                 
                    
                    var inner2 ='                                                                                <div class="table-responsive">'+
'        <table id="tabeldata" class="table table-vcenter table-hover table-condensed table-striped table-borderless">'+
'            <thead>'+
'                <tr>'+
'                    <th class="text-center" style="width: 30px;">No.</th>'+
'                                            <th class="text-center">Lokasi</th>'+
'                                            <th class="text-center">Kecamatan</th>'+
'                                            <th class="text-center">Kelurahan</th>'+
'                                            <th class="text-center">Status</th> '+
'                                            <th class="text-center" style="width: 90px;"><i class="fa fa-flash"></i> Aksi</th>'+
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
'                                                <td>'+obj.nama_lokasi+'</td>'+
'                                                <td class="text-center">'+obj.kecamatan+'</td>'+
'                                                <td class="text-center">'+obj.lokasi_keg+'</td>'+
'                                                <td class="text-center">'+obj.rencana+'</td>'+
'                                                <td class="text-center">'+

'                                                <a href="kumuh/'+obj.id+'" data-toggle="tooltip" title="Lihat Peta" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-map"></i></a>'+

'                                                </td>'+
'                                                '+
'                                            </tr>';
});
                









                    document.getElementById("modal").innerHTML = inner + inner2 + inner3;
                    $('#modal').show();
                    $('#myModal').modal('show');



                  },
                  error: function(e) {
                    console.log(e);
                  }
                });
    }
</script>

<script type="text/javascript">

    var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                	// paging: false,
                	// searching: false,
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
<!-- 
<script>$(function () {
                                        UiTables.init();
                                    });</script> -->


@endsection