@extends('layouts.admin.main')

@section('seo-title')
Data
@endsection

@section('title')
<span class="gi gi-compass"></span> DATA
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

                            <a href="{{Request::URL()}}/create" class="btn btn-effect-ripple btn-success"> <i class="fa fa-plus"></i> Tambah Data</a>
                            <div class="table-responsive" style="padding-top: 10px;">
                                <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 50px;">No.</th>
                                            <th>Daerah</th>
                                            <th>Judul Pekerjaan</th>
                                            <th>Lokasi</th>
                                            <th>Nama Perusahaan</th>
                                            <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	@foreach($datas as $no => $data)
	                                    	<tr>
	                                    		<td class="text-center">{{$no+1}}</td>
                                                <td>{{$data->daerah->nama_daerah}}</td>
	                                    		<td>{{$data->judul_pekerjaan}}</td>
	                                    		<td>{{$data->lokasi}}</td>
                                                <td>{{$data->nama_pr}}</td>
	                                    		<td class="text-center">
	                                    		<a href="{{Request::URL().'/'.$data->id}}" data-toggle="tooltip" title="Detail Data" class="btn btn-effect-ripple btn-sm btn-info"><i class="gi gi-circle_info"></i></a>
                                                <a href="{{Request::URL().'/'.$data->id.'/edit'}}" data-toggle="tooltip" title="Ubah Data" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-pencil"></i></a>

                                                <a
		                                            onclick="event.preventDefault();
		                                                     document.getElementById('hapus-form-{{$data->id}}').submit();"
		                                            data-toggle="tooltip" title="Hapus Data" class="btn btn-effect-ripple btn-sm btn-danger"
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
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
</div>
<!-- END Get Started Block -->
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
                    columnDefs: [ { orderable: false, targets: [5], searchable:false } ],
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
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGsxcGOZ82-QA1VoN4Iqb-eBaSXPqKsmY&callback=initMap" async defer></script>
@endpush