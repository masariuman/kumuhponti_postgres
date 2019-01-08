@extends('layouts.admin.main')

@section('seo-title')
Data
@endsection

@section('title')
<span class="fa fa-database"></span> DATA
@endsection

@section('breadcrumbs')
<ul class="breadcrumb breadcrumb-top">
	<li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="/admin/data">Data</a></li>
</ul>
@endsection

@section('main')
<!-- Get Started Block -->
<div class="block full">
	    <!-- Get Started Content -->
	    	<!-- Datatables Block -->
                        <!-- Datatables is initialized in js/pages/uiTables.js -->
                        <div class="block full">
                            <div class="block-title">
                                <h2>Tabel Data</h2>
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
                            <button href="#modalTambah" data-toggle="modal" class="btn btn-effect-ripple btn-success"> <i class="fa fa-plus"></i> Tambah Data</button>
                            <div class="table-responsive" style="padding-top: 10px;">
                                <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No.</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($datas as $no => $data)
	                                    	<tr>
	                                    		<td class="text-center">{{$no+1}}</td>
	                                    		<td>{{$data->nama}}</td>
	                                    		<td>{{$data->alamat}}</td>
	                                    		<td class="text-center">
	                                    		<a href="javascript:modalDetail({{$data->id}})" data-toggle="tooltip" title="Detail Data" class="btn btn-effect-ripple btn-sm btn-info"><i class="gi gi-circle_info"></i></a>
                                                <a href="javascript:modalUbah({{$data->id}})" data-toggle="tooltip" title="Ubah Data" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:modalHapus({{$data->id}})" data-toggle="tooltip" title="Hapus Data" class="btn btn-effect-ripple btn-sm btn-danger"><i class="fa fa-times"></i></a>
                                            </td>
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

<div id="modal">
	
</div>
<!-- Regular Fade -->
<div id="modalTambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #afde5c; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Tambah Data</h4>
            </div>
            <div class="modal-body">
                <form method="post" class="form-bordered">
                {{csrf_field()}}
                    <div class="form-group">
                        <label >Nama</label>
                        <input class="form-control" name="nama" type="text" >
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat"></textarea>
                    </div>
                    <div class="form-group">
                    	<label>Deskrispsi</label>
                    	<textarea id="deskripsi" class="form-control" name="deskripsi" ></textarea>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Latitude</label>
                            <input id="x" type="number" name="x" class="form-control" step="any" max="999" value="-0.15814501846297607">   
                        </div>
                        <div class="col-xs-6">
                            <label>Longitude</label>
                            <input id="y" type="number" name="y" class="form-control" step="any" max="999" value="109.4182775878906">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label">Gambar Utama</label>
                          <div class="input-group">
                            <span class="input-group-btn">
                              <a id="lfm1" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
                                <i class="fa fa-picture-o"></i> Pilih
                              </a>
                            </span>
                            <input id="thumbnail" class="form-control" type="text" name="foto">
                          </div>
                          <div class="container-fluid">
                            <center><img id="holder" style="margin-top:15px;max-height:100px;" src=""></center>
                          </div>
                    </div>      
                    <div class="form-group">
                    	<label>Lihat Peta : </label>
						<p><label>Off</label> <label class="switch switch-success"><input id="ck" type="checkbox"><span></span></label> <label>On</label></p>
                    </div>
                    <div class="form-group" id="peta" style="display: none;">
                        <div class="text-danger"> Catatan : Dengan Menyeret Marker Pada Peta sudah Mengubah Latitude dan Longitude diatas</div>
                        <div class="form-control" style="height: 400px;">
                            <div id="map" style="height: 400px;"></div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-effect-ripple btn-primary">Simpan</button>
                </form>
                <button type="button" class="btn btn-effect-ripple btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<!-- END Regular Fade -->
@endsection

@push('js')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>


<script type="text/javascript">
    $('#lfm1').filemanager('image');
    CKEDITOR.replace( 'deskripsi' , {
      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
    });
</script>

<script type="text/javascript">
    var map;
    var markers;
    var myLatLng;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.8688, lng: 151.2195},
        zoom: 13,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      return map;
    }

    //check checkboxmap
    $("#ck").change( function(){
        if($("#ck").prop( "checked" )) {
            $("#peta").show();
            google.maps.event.trigger(map, 'resize');
            myLatLng = {lat:parseFloat($('#x').val()),lng:parseFloat($('#y').val())};
            console.log(myLatLng);
            map.setCenter(myLatLng);
            map.setZoom(15);
            var marker = new google.maps.Marker({
                    position: myLatLng,
                    draggable: true,
                    icon:'/marker/icon.png',
                    visible: true,
                    // zIndex:3,
                    map: map
                });
            google.maps.event.addListener(marker, 'dragend', function(event) {
                 // alert();
                $('#x').val(String(event.latLng.lat()));
                $('#y').val(String(event.latLng.lng()));
            } );
        } else {
            $("#peta").hide();
        }
    });

    //data tables
    var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                    columnDefs: [ { orderable: false, targets: [3] } ],
                    pageLength: 10,
                    lengthMenu: [[5, 10, 20], [5, 10, 20]],
                });
            }
        };
    }();

    //modal detail
    function modalDetail(id) {
    			$.ajax({
    			  type:"GET",
    			  url:"/cari-data/"+id,
                  dataType: 'json',
                  success: function(hasil){
                  	$('#modal').empty();
    		         document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
    																  '<div class="modal-dialog modal-lg" role="document">'+
    																    '<div class="modal-content">'+
    																      '<div class="modal-header" style="background-color:#5cafde; color:white;">'+
    																        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
    																        '<h4 class="modal-title" id="myModalLabel">Detail Data</h4>'+
    																      '</div>'+
    																      '<div class="modal-body">'+
                                                                            '<table><tr>'+
                                                                            '<td width="75%">'+
                                                                                  '<p><strong>Nama: </strong>'+hasil['nama']+'</p>'+
                                                                                  '<p><strong>Alamat: </strong>'+hasil['alamat']+'</p>'+
                                                                                  '<p><strong>Deskripsi: </strong>'+hasil['deskripsi']+'</p>'+
                                                                                  '<p><strong>Latitude: </strong>'+hasil['x']+'</p>'+
                                                                                  '<p><strong>Longitude: </strong>'+hasil['y']+'</p>'+
                                                                            '</td>'+
                                                                            '<td>'+
                                                                                '<img class="img img-rounded" width="500px" height="300px;" src="'+hasil['foto']+'">'+
                                                                            '</td>'+
                                                                            '</tr>'+
                                                                            '</table>'+
    																      '</div>'+
    																      '<div class="modal-footer">'+
    																        '<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>'+
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

    //modal ubah
    function modalUbah(id) {
                $.ajax({
                  type:"GET",
                  url:"/cari-data/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#5ccdde; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Ubah Data</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body">'+
                                                                                '<form method="post" class="form-bordered">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="PUT">'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Nama</label>'+
                                                                                        '<input class="form-control" name="nama" type="text" value="'+hasil['nama']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Alamat</label>'+
                                                                                        '<textarea class="form-control" name="alamat">'+hasil['alamat']+'</textarea>'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Deskrispsi</label>'+
                                                                                        '<textarea class="form-control" id="deskripsi" name="deskripsi" >'+hasil['deskripsi']+'</textarea>'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<div class="col-xs-6">'+
                                                                                            '<label>Latitude</label>'+
                                                                                            '<input type="number" name="x" class="form-control" step="any" max="999" value="'+hasil['x']+'">'+
                                                                                        '</div>'+
                                                                                        '<div class="col-xs-6">'+
                                                                                            '<label>Longitude</label>'+
                                                                                            '<input type="number" name="y" class="form-control" step="any" max="999" value="'+hasil['y']+'">'+
                                                                                        '</div>'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                      '<label class="control-label">Gambar Utama</label>'+
                                                                                          '<div class="input-group">'+
                                                                                            '<span class="input-group-btn">'+
                                                                                              '<a id="lfm2" data-input="thumbnail2" data-preview="holder" class="btn btn-warning">'+
                                                                                                '<i class="fa fa-picture-o"></i> Pilih'+
                                                                                              '</a>'+
                                                                                            '</span>'+
                                                                                            '<input id="thumbnail2" class="form-control" type="text" name="foto" value="'+hasil['foto']+'">'+
                                                                                          '</div>'+
                                                                                          '<div id="hintThumb"></div>'+
                                                                                          '<div class="container-fluid">'+
                                                                                            '<center><img id="holder" style="margin-top:15px;max-height:100px;" src="'+hasil['foto']+'"></center>'+
                                                                                          '</div>'+
                                                                                    '</div>'+
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
                    $('#lfm2').filemanager('image');
                    CKEDITOR.replace( 'deskripsi' , {
                      filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                      filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                      filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                      filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'
                    });
                  },
                  error: function(e) {
                    console.log(e);
                  }
                });
    }

    //modal ubah
    function modalHapus(id) {
                $.ajax({
                  type:"GET",
                  url:"/cari-data/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#de815c; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Hapus Data</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body" align="center" style="color:red;">'+
                                                                          '<h3><strong>Apakah kamu yakin akan menghapus data </strong></h3>'+
                                                                          '<p><strong>Nama: </strong>'+hasil['nama']+'</p>'+
                                                                          '<p><strong>Alamat: </strong>'+hasil['alamat']+' <strong>?</strong></p>'+
                                                                          '</div>'+
                                                                          '<div class="modal-footer">'+
                                                                            '<form method="post">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="delete">'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
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

</script>
<script>$(function () {
                                        UiTables.init();
                                    });</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGsxcGOZ82-QA1VoN4Iqb-eBaSXPqKsmY&callback=initMap" async defer></script>                                    
@endpush