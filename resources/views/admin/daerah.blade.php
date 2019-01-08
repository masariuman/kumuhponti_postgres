@extends('layouts.admin.main')

@section('seo-title')
Data Daerah
@endsection

@section('title')
<span class="gi gi-map"></span> Daerah
@endsection

@section('breadcrumbs')
<ul class="breadcrumb breadcrumb-top">
	<li><a href="/admin/dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
	<li><a href="#"> Daerah</a></li>
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
		                                            <th>Nama daerah</th>
		                                            <th>Latitude</th>
		                                            <th>Longitude</th>
		                                            <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
		                                        </tr>
		                                    </thead>
		                                    <tbody>
		                                    	@foreach($daerah as $no => $data)
			                                    	<tr>
			                                    		<td class="text-center">{{$no+1}}</td>
			                                    		<td>{{$data->nama_daerah}}</td>
			                                    		<td>{{$data->x}}</td>
		                                                <td>{{$data->y}}</td>
			                                    		<td class="text-center">
		                                                <button 
		                                                	    data-toggle="tooltip" 
		                                                	    data-id="{{ $data->id }}"
		                                                	    data-nama="{{ $data->nama_daerah }}"
		                                                	    data-x="{{ $data->x }}"
		                                                	    data-y="{{ $data->y }}"
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
<div id="tambah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                	<label>Nama Daerah</label>
                	<input type="text" name="nama_daerah" class="form-control" maxlength="191" required="">
                </div>
                <div class="form-group">
                	<label>Latitude</label>
                	<input type="number" name="x" step="0.00000001" class="form-control" maxlength="191" required="" value="-0,026779173829702012">
                </div>
                <div class="form-group">
                	<label>Longitude</label>
                	<input type="number" name="y" step="0.00000001" class="form-control" maxlength="191" required="" value="109,34211730957031">
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
<div id="ubah" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
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
                	<label>Nama Daerah</label>
                	<input type="text" name="nama_daerah" class="form-control" maxlength="191" required="">
                </div>
                <div class="form-group">
                	<label>Latitude</label>
                	<input type="number" name="x" step="0.00000001" class="form-control" maxlength="191" required="">
                </div>
                <div class="form-group">
                	<label>Longitude</label>
                	<input type="number" name="y" step="0.00000001" class="form-control" maxlength="191" required="">
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
<script type="text/javascript">

	var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                    columnDefs: [ 
                    { orderable: false, targets: [4], searchable: false } 
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

	});

	$('.ubah-data').click(function(){
		$('#ubah form input[name=nama_daerah]').val($(this).data('nama'));
		$('#ubah form input[name=x]').val($(this).data('x'));
		$('#ubah form input[name=y]').val($(this).data('y'));
		$('#ubah form').attr('action','{{Request::url()}}/'+$(this).data('id'));
		$('#ubah').modal('show');
	});
</script>

@endpush