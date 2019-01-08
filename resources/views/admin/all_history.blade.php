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
                                <h2>Riwayat Pembaharuan</h2>                                
                            </div>



                            <div class="table-responsive" style="padding-top: 10px;">
                                <table id="tabeldata" class="table table-striped table-bordered table-vcenter">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width: 30px;padding:5px;">No.</th>
                                            <th class="text-center" style="width: 30px;padding:5px;">Data Gambar</th>
                                            <th class="text-center">Lokasi</th>
                                            <th class="text-center" style="padding:5px;">Kecamatan</th>
                                            <th class="text-center">Kelurahan</th>
                                            <th class="text-center">Luas</th>
                                            <th class="text-center">Status</th> 
                                            <th class="text-center">Last Updated by</th>
                                            <th class="text-center">Jenis Update</th>
                                            <th class="text-center">Catatan</th>
                                            <th class="text-center" style="width: 30px;padding:5px;">Aksi</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @foreach($datas as $no => $data)
                                                <tr>
                                                    <td class="text-center">{{$no+1}}</td>
                                                    <td class="text-center">{!! ( empty($data->data) ) ? '<span class="fa fa-close" style="color: red;"></span>' : '<span class="fa fa-check" style="color: green;"></span>' !!}</td>
                                                    <td>{{$data->lokasi}}</td>
                                                    <td class="text-center">{{$data->kecamatan}}</td>
                                                    <td class="text-center">{{$data->kelurahan}}</td>
                                                    <td class="text-center">{{$data->luas}}</td>
                                                    <td class="text-center">{{$data->status}}</td>
                                                    
                                                    <td class="text-center">{{$data->user->name}}<br>{{date('d F Y', strtotime($data->created_at))}}<br>{{date('H:i:s', strtotime($data->created_at))}}</td>  
                                                    <td class="text-center">{{$data->kategori_update}}</td>   
                                                    <td class="text-center">{{$data->catatan}}</td> 
                                                    <td class="text-center">
                                                    <!-- <a href="{{Request::URL().'/'.$data->id}}" data-toggle="tooltip" title="Detail Data" class="btn btn-effect-ripple btn-sm btn-info"><i class="gi gi-circle_info"></i></a> -->
                                                    <a href="{{'/admin/kumuh/history/show/'.$data->id}}" data-toggle="tooltip" title="Lihat Data" class="btn btn-effect-ripple btn-sm btn-primary"><i class="fa fa-eye"></i></a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript">

    var UiTables = function() {

        return {
            init: function() {
                /* Initialize Bootstrap Datatables Integration */
                App.datatables();

                /* Initialize Datatables */
                $('#tabeldata').dataTable({
                    columnDefs: [ { orderable: false, targets: [11], searchable:false } ],
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

@endpush