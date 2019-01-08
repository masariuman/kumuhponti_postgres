@extends('layouts.admin.main')

@section('seo-title')
Tampilan
@endsection

@section('title')
<span class="gi gi-compass"></span> Tampilan
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
                                <h2>Ubah Tampilan</h2>
                            </div>
                            <div class="container-fluid" style="padding-top: 10px;">

                                <form method="post" name="valid" onsubmit="return validasiubah()">
                                {{csrf_field()}}
                                {{ method_field('PUT') }}

                                    <div class="form-group">
                                      <label class="control-label">Favicon </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail" class="form-control" type="text" name="favicon" value="{{$datas->favicon}}">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder" style="margin-top:15px;max-height:100px;" src="{{$datas->favicon}}"></center>
                                          </div>
                                    </div>

                                    <div class="form-group">
                                      <label class="control-label">Logo 1 </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm1" data-input="thumbnail1" data-preview="holder1" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail1" class="form-control" type="text" name="logo_instansi" value="{{$datas->logo_instansi}}">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder1" style="margin-top:15px;max-height:100px;" src="{{$datas->logo_instansi}}"></center>
                                          </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Nama Instansi</label>
                                        <input type="text" name="nama_instansi" class="form-control" maxlength="191" required="" value="{{$datas->nama_instansi}}">
                                    </div>
 -->
                                    <!-- <div class="form-group">
                                      <label class="control-label">Logo 1 </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm2" data-input="thumbnail2" data-preview="holder2" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail2" class="form-control" type="text" name="logo_pem" value="{{$datas->logo_pem}}">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder2" style="margin-top:15px;max-height:100px;" src="{{$datas->logo_pem}}"></center>
                                          </div>
                                    </div> -->
                                  <!--   <div class="form-group">
                                        <label>Nama Pemerintah</label>
                                        <input type="text" name="nama_pem" class="form-control" maxlength="191" required="" value="{{$datas->nama_pem}}">
                                    </div>
 -->

                                    <div class="form-group">
                                      <label class="control-label">Logo 2 </label>
                                          <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="lfm3" data-input="thumbnail3" data-preview="holder3" class="btn btn-warning">
                                                <i class="fa fa-picture-o"></i> Pilih
                                              </a>
                                            </span>
                                            <input id="thumbnail3" class="form-control" type="text" name="logo_aplikasi" value="{{$datas->logo_aplikasi}}">
                                          </div>
                                          <div class="container-fluid">
                                            <center><img id="holder3" style="margin-top:15px;max-height:100px;" src="{{$datas->logo_aplikasi}}"></center>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Nama Aplikasi</label>
                                        <input type="text" name="nama_aplikasi" class="form-control" maxlength="191"  value="{{$datas->nama_aplikasi}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Judul Website</label>
                                        <input type="text" name="site_title" class="form-control" maxlength="191"  value="{{$datas->site_title}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Deskripsi Website</label>
                                        <input type="text" name="site_desc" class="form-control" maxlength="191"  value="{{$datas->site_desc}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Keyword Website</label>
                                        <input type="text" name="site_keyword" class="form-control" maxlength="191"  value="{{$datas->site_keyword}}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tentang Website</label>
                                        <textarea type="text" name="tentang" class="form-control tentang" >{{$datas->tentang}}</textarea>
                                    </div>

                                    <div class="form-group"><br>
                                        <label>Titik Tengah Peta</label><br>
                                        <input class="hidden" id="generate_text" type="button" value="Generate Map Text" onclick="BlitzMap.toJSONString()" />
                                        <textarea hidden="hidden" id="mapData" style="width:100%; height:300px" name="tengah">{{ $datas->tengah }}</textarea>
                                        <div class="col-md-12">
                                            <div id="myMap" style="min-height:700px; width:100%;"></div>
                                        </div><br>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" style="margin-top:10px;" class="btn btn-primary pull-right">Simpan <i class="fa fa-arrow-circle-down"></i></button>
                                    </div>
                                </form> 

                            </div>
                        </div>
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
<!-- END Get Started Block -->

@endsection

@push('js')

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD8iakYfGi4g2t_w07QQV0W5IdfUY2v4mc&libraries=drawing,geometry,places" type="text/javascript"></script>
<script type="text/javascript" src="/geoxml3/kmz/geoxml3.js"></script>
<script type="text/javascript" src="/geoxml3/ProjectedOverlay.js"></script>
<script type="text/javascript" src="/geoxml3/kmz/ZipFile.complete.js"></script>
<script src="/blitz/jscolor/jscolor.js" type="text/javascript"></script>
<script src="/blitz/json2.js" type="text/javascript"></script>
<script src="/blitz/xmlwriter.js" type="text/javascript"></script>
<script src="/blitz/blitz.gmap3.js" type="text/javascript"></script>

<script type="text/javascript">
        var map = BlitzMap.setMap( 'myMap', true, 'mapData' );
        
        // $('form').on('keyup keypress', function(e) {
        //   var keyCode = e.keyCode || e.which;
        //   if (keyCode === 13) { 
        //     e.preventDefault();
        //     return false;
        //   }
        // });

  //       $('#pac-input').keydown(function(e){         
        //     if(e.which == 32){     
        //         e.preventDefault();            
        //     }        
        // });


        function runScript(e) {
            //See notes about 'which' and 'key'
            if (e.keyCode == 13) {
                return false;
            }
        }

         // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        /*map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });*/

        
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();
          
          BlitzMap.SearchBox(places);
        });


</script>
<script>
    function generate() {
        $('#generate_text').trigger('click');
        return false;
    }
</script>




<!-- Load and execute javascript code used only in this page -->
<script src="/admin/js/pages/formsWizard.js"></script>
<script>$(function(){ FormsWizard.init(); });</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script type="text/javascript">
    $('#lfm').filemanager('image');
    $('#lfm1').filemanager('image');
    $('#lfm2').filemanager('image');
    $('#lfm3').filemanager('image');
    CKEDITOR.replace( 'tentang' );
</script>
<script>
  function validasiubah() {
        var pavicon= document.forms["valid"]["favicon"].value;
        var logo_aplikasi= document.forms["valid"]["logo_aplikasi"].value;
        var logo_instansi= document.forms["valid"]["logo_instansi"].value;
        var nama_aplikasi= document.forms["valid"]["nama_aplikasi"].value;
        var site_title= document.forms["valid"]["site_title"].value;
        var site_keyword= document.forms["valid"]["site_keyword"].value;
        var site_desc= document.forms["valid"]["site_desc"].value;
        // var tentang= document.forms["valid"]["tentang"].value;
        var page_content = CKEDITOR.instances['tentang'].getData();
        if ( pavicon== "") {
            alert("Data favicon harus diisi");
            return false;
        }
        if ( logo_aplikasi== "") {
            alert("Data logo 2 harus diisi");
            return false;
        }
        if ( logo_instansi== "") {
            alert("Data logo 1 harus diisi");
            return false;
        }
        if ( nama_aplikasi== "") {
            alert("Data nama aplikasi harus diisi");
            return false;
        }
        if ( site_title== "site_title") {
            alert("Data judul Website harus diisi");
            return false;
        }
        if ( site_keyword== "") {
            alert("Data Keyword Website harus diisi");
            return false;
        }
        if ( site_desc== "") {
            alert("Data Deskripsi Website harus diisi");
            return false;
        }
        // if ( tentang== "") {
        //     alert("Data tentang harus diisi");
        //     return false;
        // }
        // if ( tentang=== null) {
        //     alert("Data tentang harus diisi");
        //     return false;
        // }
        if ( page_content.length ==  0) {
          alert("Data tentang harus diisi");
            return false;
        }
        $('#generate_text').trigger('click');
        // return false;
    }
</script>
@endpush