@extends('layouts.admin.main')

@section('seo-title')
User
@endsection

@section('title')
<span class="fa fa-users"></span> User
@endsection

@section('breadcrumbs')
<ul class="breadcrumb breadcrumb-top">
	<li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
    <li><a href="/admin/user">User</a></li>
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
                                <h2>Tabel User</h2>
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
                             @if(session()->get('message')=="salah")
                            <!-- Success Alert -->
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong><i class="gi gi-warning_sign"></i> Gagal</strong></h4>
                                        <p>Password Lama Tidak Cocok dengan yang Tersimpan di Dalam Database</p>
                                    </div>
                            <!-- END Success Alert -->
                            {{session()->forget('message')}}
                            @endif
                             @if(session()->get('message')=="salah2")
                            <!-- Success Alert -->
                                    <div class="alert alert-danger alert-dismissable">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <h4><strong><i class="gi gi-warning_sign"></i> Gagal</strong></h4>
                                        <p>Password Akun yang Akan Dihapus Tidak Cocok dengan yang Tersimpan di Dalam Database</p>
                                    </div>
                            <!-- END Success Alert -->
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
	                                    		<td>{{$data->name}}</td>
	                                    		<td>{{$data->email}}</td>
	                                    		<td class="text-center">
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
                <form method="post" class="form-bordered" name="valids" onsubmit="return validasitambah()">
                {{csrf_field()}}
                    <div class="form-group">
                        <label >Nama</label>
                        <input class="form-control" name="name" type="text" >
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email" type="email" >
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" name="password" type="password" >
                    </div>
                    <div class="form-group">
                      <label class="control-label">Foto </label>
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
</script>

<script type="text/javascript">
 
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
                    "language": {
                        "url": "http://cdn.datatables.net/plug-ins/1.10.9/i18n/Indonesian.json",
                        "sEmptyTable": "Tidak ada data di database"
                    }
                });
            }
        };
    }();

    //modal ubah
    function modalUbah(id) {
                $.ajax({
                  type:"GET",
                  url:"/api/cari-user/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#5ccdde; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Ubah User</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body">'+
                                                                                '<form method="post" class="form-bordered" name="validss" onsubmit="return validasiubah()">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="PUT">'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label >Nama</label>'+
                                                                                        '<input class="form-control" name="name" type="text" value="'+hasil['name']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Email</label>'+
                                                                                        '<input class="form-control" name="email" type="email" value="'+hasil['email']+'">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Password Lama</label>'+
                                                                                        '<input class="form-control" name="old_password" type="password" value="">'+
                                                                                    '</div>'+
                                                                                    '<div class="form-group">'+
                                                                                        '<label>Password Baru</label>'+
                                                                                        '<input class="form-control" name="password" type="password" value="">'+
                                                                                    '</div>'+
                                                                                     '<div class="form-group">'+
                                                                                      '<label class="control-label">Foto</label>'+
                                                                                          '<div class="input-group">'+
                                                                                            '<span class="input-group-btn">'+
                                                                                              '<a id="lfm2" data-input="thumbnail2" data-preview="holder" class="btn btn-warning">'+
                                                                                                '<i class="fa fa-picture-o"></i> Pilih'+
                                                                                              '</a>'+
                                                                                            '</span>'+
                                                                                            '<input id="thumbnail2" class="form-control" type="text" name="foto" value="'+hasil['foto']+'">'+
                                                                                          '</div>'+
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
                  url:"/api/cari-user/"+id,
                  dataType: 'json',
                  success: function(hasil){
                    $('#modal').empty();
                     document.getElementById("modal").innerHTML =  '<div id="myModal" class="modal fade" tabindex="-1" role="dialog">'+
                                                                      '<div class="modal-dialog modal-lg" role="document">'+
                                                                        '<div class="modal-content">'+
                                                                          '<div class="modal-header" style="background-color:#de815c; color:white;">'+
                                                                            '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                                                                            '<h4 class="modal-title" id="myModalLabel">Hapus User</h4>'+
                                                                          '</div>'+
                                                                          '<div class="modal-body" align="center" style="color:red;">'+
                                                                          '<h3><strong>Apakah kamu yakin akan menghapus data </strong></h3>'+
                                                                          '<p><strong>Nama: </strong>'+hasil['name']+'</p>'+
                                                                          '<p><strong>Email: </strong>'+hasil['email']+' <strong>?</strong></p>'+
                                                                          '</div>'+
                                                                          '<div class="modal-footer">'+
                                                                            '<form method="post">'+
                                                                                '{{csrf_field()}}'+
                                                                                '<input type="hidden" name="_method" value="delete">'+
                                                                                '<input type="hidden" name="id" value="'+id+'">'+
                                                                                '<div class="form-group">'+
                                                                                        '<label style="float:left;">Masukkan Password dari Akun Untuk Konfirmasi Penghapusan</label>'+
                                                                                        '<input class="form-control" name="password" type="password" value="">'+
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

</script>
<script>$(function () {
                                        UiTables.init();
                                    });</script>

<script>
    function validasitambah() {
        // alert('work');
        var name     = document.forms["valids"]["name"].value;
        var email     = document.forms["valids"]["email"].value;
        var password     = document.forms["valids"]["password"].value;
        var foto     = document.forms["valids"]["foto"].value;
        // alert(name);
        if ( name== "") {
            alert("Data nama harus diisi");
            return false;
        }
        if ( email== "") {
            alert("Data email harus diisi");
            return false;
        }
        if ( password== "") {
            alert("Data password harus diisi");
            return false;
        }
        if ( foto== "") {
            alert("Data foto harus diisi");
            return false;
        }
    }

    function validasiubah() {
        // alert('work');
        var name     = document.forms["validss"]["name"].value;
        var email     = document.forms["validss"]["email"].value;
        var old_password     = document.forms["validss"]["old_password"].value;
        var password     = document.forms["validss"]["password"].value;
        var foto     = document.forms["validss"]["foto"].value;
        // alert(name);
        if ( name== "") {
            alert("Data nama harus diisi");
            return false;
        }
        if ( email== "") {
            alert("Data email harus diisi");
            return false;
        }
        if ( old_password== "") {
            alert("Data password lama harus diisi");
            return false;
        }
        if ( password== "") {
            alert("Data password baru harus diisi");
            return false;
        }
        if ( foto== "") {
            alert("Data foto harus diisi");
            return false;
        }
    }
</script>
@endpush