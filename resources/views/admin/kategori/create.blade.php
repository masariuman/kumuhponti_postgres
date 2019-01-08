@extends('layouts.admin.main')

@section('seo-title')
Kategori
@endsection

@section('title')
<span class="gi gi-compass"></span> Kategori
@endsection

@push('css')

@endpush

@section('main')

<!-- Get Started Block -->
	    <!-- Get Started Content -->
	    	<!-- Datatables Block -->
                        <!-- Datatables is initialized in js/pages/uiTables.js -->
                        <div class="block full">
                            <div class="block-title">
                                <h2>Tambah Kategori</h2>
                            </div>
                            <div class="container-fluid" style="padding-top: 10px;">

                                <form method="post" action="{{url('/admin/kategori')}}">
                                {{csrf_field()}}
                                    <div class="form-group">
                                        <label>Nama</label>
                                        <input type="text" name="nama" class="form-control" maxlength="191" required="">
                                    </div>
                                    <div class="form-group">
                                      <label class="control-label">Icon </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="icon">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder" style="margin-top:15px;max-height:100px;" src=""></center>
                                          </div>
                                    </div>      
                                    <div class="form-group">
                                      <label class="control-label">Icon Expired </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="icon_ex">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder1" style="margin-top:15px;max-height:100px;" src=""></center>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-danger pull-left"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
                                        <button type="submit" class="btn btn-primary pull-right">Simpan <i class="fa fa-arrow-circle-down"></i></button>
                                    </div>
                                </form> 

                            </div>
                        </div>
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
<!-- END Get Started Block -->
@endsection

@push('js')
<!-- Load and execute javascript code used only in this page -->
<script src="/admin/js/pages/formsWizard.js"></script>
<script>$(function(){ FormsWizard.init(); });</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script type="text/javascript">
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
</script>
@endpush