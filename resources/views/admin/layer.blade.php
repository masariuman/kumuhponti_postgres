@extends('layouts.admin.main')

@section('seo-title')
Data Layer
@endsection

@section('title')
<span class="gi gi-map"></span> Layer
@endsection

@section('breadcrumbs')
<ul class="breadcrumb breadcrumb-top">
	<li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	<li><a href="#"> Layer</a></li>
</ul>
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<style type="text/css">
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
@endpush

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
                            <div class="row">
                            	<div class="col-md-12">
                            		<button class="btn btn-effect-ripple btn-success pull-right" data-toggle="modal" data-target="#tambah"> <i class="fa fa-plus"></i> Tambah Data</button>
                            	</div>
                            	<div class="col-md-12">
                            		<div class="table-responsive" style="padding-top: 10px;">
		                                <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
		                                    <thead>
		                                        <tr>
		                                            <th class="text-center" style="width: 50px;">No.</th>
		                                            <th>Daerah</th>
		                                            <th>Nama Layer</th>
		                                            <th>Kategori Layer</th>
		                                            <th>File Layer</th>
		                                            <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    	@foreach($layer as $no => $data)
			                                    	<tr>
			                                    		<td class="text-center">{{$no+1}}</td>
			                                    		<td>{{$data->daerah->nama_daerah}}</td>
			                                    		<td>{{$data->nama_layer}}</td>
			                                    		<td>{{$data->kategori->nama}}</td>
		                                                <td class="text-center" ><a href="{{$data->link_layer}}"><i class="fa fa-download"></i> Download Files</a></td>
			                                    		<td class="text-center">
		                                                <button 
		                                                	    data-toggle="tooltip" 
		                                                	    data-id="{{ $data->id }}"
		                                                	    data-nama="{{ $data->nama_layer }}"
		                                                	    data-daerah="{{ $data->daerah->id }}"
		                                                	    data-kategori="{{ $data->kategori->id }}"
                                                                data-link="{{ $data->link_layer }}"
		                                                	    title="Ubah Data" 
		                                                	    class="btn btn-effect-ripple btn-sm btn-primary ubah-data"

		                                                ><i class="fa fa-pencil"></i></button>

		                                                <a 
		                                                    data-toggle="tooltip" title="Hapus Data" class="btn btn-effect-ripple btn-sm btn-danger"
		                                                    @if($data->nama!='default')
		    		                                            onclick="event.preventDefault();
		    		                                                     document.getElementById('hapus-form-{{$data->id}}').submit();"
		                                                    @else
		                                                    disabled
		                                                    @endif

														>
				                                            <i class="fa fa-times"></i>
				                                        </a>

				                                        <form id="hapus-form-{{$data->id}}" action="{{ Request::URL().'/'.$data->id }}" method="POST" style="display: none;">
				                                            {{ csrf_field() }}
		                                                    {{ method_field('DELETE') }}
				                                        </form>
		                                            </td>
			                                    	</tr>
			                                    @endforeach
		                                    </tbody>
		                                </table>
		                            </div>	
                            	</div>
                            </div>
                        </div>
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
</div>
<!-- END Get Started Block -->

<!-- tambah -->
<div id="tambah" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: aqua; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Tambah Data</strong></h3>
            </div>
            <form method="POST">
            	{{ csrf_field() }}
            <div class="modal-body">
            	<div class="form-group">
                	<label>Daerah</label>
                	<select name="daerahs_id" class="form-control select2" required="">
                		<option value="">Pilih</option>
                		@foreach($daerah as $data)
                			<option value="{{ $data->id }}">{{ $data->nama_daerah }}</option>
                		@endforeach
                	</select>
                </div>
                <div class="form-group">
                	<label>Kategori</label>
                	<select name="kategoris_id" class="form-control select2" required="">
                		<option value="">Pilih</option>
                		@foreach($kategori as $data)
                			<option value="{{ $data->id }}">{{ $data->nama }}</option>
                		@endforeach
                	</select>
                </div>
                <div class="form-group">
                	<label>Nama Layer</label>
                	<input type="text" name="nama_layer" class="form-control" maxlength="191" required="">
                </div>
                <div class="form-group">
                	<label>File Layer</label>
                	<div class="input-group">
	                  <span class="input-group-btn">
	                    <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
	                      <i class="fa fa-picture-o"></i> Pilih
	                    </a>
	                  </span>
	                  <input id="thumbnail" class="form-control" type="text" name="link_layer">
	                </div>
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

<!-- ubah -->
<div id="ubah" class="modal fade" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: aqua; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title"><strong>Ubah Data</strong></h3>
            </div>
            <form method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

            <div class="modal-body">
                <div class="form-group">
                    <label>Daerah</label>
                    <select name="daerahs_id" class="form-control select2" required="">
                        <option value="">Pilih</option>
                        @foreach($daerah as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_daerah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select name="kategoris_id" class="form-control select2" required="">
                        <option value="">Pilih</option>
                        @foreach($kategori as $data)
                            <option value="{{ $data->id }}">{{ $data->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Nama Layer</label>
                    <input type="text" name="nama_layer" class="form-control" maxlength="191" required="">
                </div>
                <div class="form-group">
                    <label>File Layer</label>
                    <div class="input-group">
                      <span class="input-group-btn">
                        <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-warning">
                          <i class="fa fa-picture-o"></i> Pilih
                        </a>
                      </span>
                      <input id="thumbnail1" class="form-control" type="text" name="link_layer">
                    </div>
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
<!-- END ubah -->
@endsection

@push('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/af.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script type="text/javascript">

	var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                    columnDefs: [ 
                    { orderable: false, targets: [5], searchable: false } 
                    ],
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
		$('.select2').select2();
		$('#lfm').filemanager('file');
        $('#lfm1').filemanager('file');
	});

	$('.ubah-data').click(function(){
		$('#ubah form input[name=nama_layer]').val($(this).data('nama'));
		$('#ubah form input[name=link_layer]').val($(this).data('link'));
		$("#ubah form select[name=daerahs_id]").val($(this).data('daerah'));
        $("#ubah form select[name=kategoris_id]").val($(this).data('kategori'));
		$('#ubah form').attr('action','{{Request::url()}}/'+$(this).data('id'));
		$('#ubah').modal('show');
	});
</script>

@endpush