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

                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{Request::URL()}}/create" class="btn btn-effect-ripple btn-success pull-right"> <i class="fa fa-plus"></i> Tambah Data</a>  
                                </div>
                                <div class="col-md-12">
                                    <div class="table-responsive" style="padding-top: 10px;">
                                        <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="width: 50px;">No.</th>
                                                    <th>Nama</th>
                                                    <th>Icon</th>
                                                    <th>Icon Expired</th>
                                                    <th class="text-center"><i class="fa fa-flash"></i> Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $no => $data)
                                                    <tr>
                                                        <td class="text-center">{{$no+1}}</td>
                                                        <td>{{$data->nama}}</td>
                                                        <td class="text-center">
                                                            @if(file_exists(public_path().$data->icon))
                                                            <img src="{{$data->icon}}" height="35" width="26">
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if(file_exists(public_path().$data->icon_ex))
                                                            <img src="{{$data->icon_ex}}" height="35" width="26">
                                                            @else
                                                            -
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                        <a href="{{Request::URL().'/'.$data->id}}" data-toggle="tooltip" title="Detail Data" class="btn btn-effect-ripple btn-sm btn-info"><i class="gi gi-circle_info"></i></a>
                                                        <a href="{{Request::URL().'/'.$data->id.'/edit'}}" data-toggle="tooltip" title="Ubah Data" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-pencil"></i></a>

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
                    columnDefs: [ { orderable: false, targets: [4], searchable:false } ],
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

@endpush