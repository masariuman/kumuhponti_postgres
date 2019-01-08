@extends('layouts.admin.main')

@section('seo-title')
Data
@endsection

@section('title')
<span class="gi gi-compass"></span> DATA
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css">
<style type="text/css">
    .controlcaripeta {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    }
    #caripeta {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 12px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
    }
    #caripeta:focus {
        border-color: #4d90fe;
    }

</style>
<style type="text/css">
    .select2-container {
        width: 100% !important;
        padding: 0;
    }
</style>
@endpush

@section('main')

<!-- Get Started Block -->
	    <!-- Get Started Content -->
	    	<!-- Datatables Block -->
                        <!-- Datatables is initialized in js/pages/uiTables.js -->
                        <div class="block full">
                            <div class="block-title">
                                <h2>Tambah Data</h2>
                            </div>
                            <div class="container-fluid" style="padding-top: 10px;">

            <!-- Clickable Wizard Content -->
        <form id="clickable-wizard" method="post" action="{{url('/admin/data')}}" class="form-horizontal form-bordered">

                <div class="form-group">
                    <label>Daerah : </label>
                    <select class="form-control select2" name="daerahs_id" required="" id="daerahs_id">
                        <option value="">Pilih Daerah</option>
                        @foreach($daerah as $data)
                            <option value="{{ $data->id }}">{{ $data->nama_daerah }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Kategori : </label>
                    <select class="form-control select2" name="kategoris_id" required="" id="kategoris_id">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                            <option value="{{$kategori->id}}">{{$kategori->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- First Step -->
                <div id="clickable-first" class="step">
                    <!-- Step Info -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <ul class="nav nav-pills nav-justified clickable-steps">
                                <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-map-marker"></i> <strong>Peta</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-four"><i class="fa fa-sticky-note"></i> <strong>SHO</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-five"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Step Info -->

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label>Latitude</label>
                            <input id="x" type="number" name="x" class="form-control" step="any" max="999" required="">   
                        </div>
                        <div class="col-xs-6">
                            <label>Longitude</label>
                            <input id="y" type="number" name="y" class="form-control" step="any" max="999" required="">
                        </div>
                    </div>
                    <div class="form-group" id="peta">
                        <div class="text-danger"> Catatan : Silahkan Letakan Marker Lokasi dengan mengklik atau menyeret marker di peta</div>
                        <div class="form-control" style="height: 400px;">
                            <input id="caripeta" class="controlcaripeta" type="text" placeholder="Cari Lokasi Disini..">
                            <div id="map" style="height: 400px;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END First Step -->

                <!-- Third Step -->
                <div id="clickable-second" class="step">
                    <!-- Step Info -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <ul class="nav nav-pills nav-justified clickable-steps">
                                <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-map-marker"></i> <strong>Peta</strong></a></li>
                                <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-four"><i class="fa fa-sticky-note"></i> <strong>SHO</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-five"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    
                    <div class="form-group">
                        <label>No.SPK</label>
                        <input type="text" name="no_spk" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal SPK</label>
                        <input type="date" name="tgl_spk" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>No. Adendum</label>
                        <input type="text" name="no_adendum" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Adendum</label>
                        <input type="date" name="tgl_adendum" class="form-control" required="">
                    </div>
                    
                    <div class="form-group">
                        <label>Judul Pekerjaan</label>
                        <input type="text" name="judul_pekerjaan" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Volume</label>
                        <input type="number" name="volume" class="form-control" min="0" value="0" required="">
                    </div>
                    <div class="form-group">
                        <label>Lokasi</label>
                        <input type="text" name="lokasi" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Kabupaten/Kota</label>
                        <input type="text" name="kab_kota" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Pagu Anggaran</label>
                        <input type="number" name="pagu" class="form-control" min="0" value="0" required="">
                    </div>
                    <div class="form-group">
                        <label>Nilai Anggaran</label>
                        <input type="number" name="nilai" class="form-control" min="0" value="0" required="">
                    </div>
                    <div class="form-group">
                        <label>Sisa Anggaran</label>
                        <input type="number" name="sisa" class="form-control" min="0" value="0" required="">
                    </div>
                    <div class="form-group">
                        <label>Persentase</label>
                        <input type="number" name="persen" class="form-control" min="0" max="100" value="0" required="">
                    </div>
                    <!--  -->
                </div>
                <!-- END Third Step -->

                <!-- Second Step -->
                <div id="clickable-third" class="step">
                    <!-- Step Info -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <ul class="nav nav-pills nav-justified clickable-steps">
                                <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-map-marker"></i> <strong>Peta</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                <li class="active" ><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-four"><i class="fa fa-sticky-note"></i> <strong>SHO</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-five"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Step Info -->

                    <div class="form-group">
                        <label>Nama Perusahaan</label>
                        <input type="text" name="nama_pr" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat Perusahaan</label>
                        <input type="text" name="alamat_pr" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Direktur</label>
                        <input type="text" name="direktur" class="form-control" maxlength="191" required="">
                    </div>
                    <!--  -->
                </div>
                <!-- END Second Step -->

                <!-- Four Step -->
                <div id="clickable-four" class="step">
                    <!-- Step Info -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <ul class="nav nav-pills nav-justified clickable-steps">
                                <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-map-marker"></i> <strong>Peta</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-four"><i class="fa fa-sticky-note"></i> <strong>SHO</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-five"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    
                    <div class="form-group">
                        <label>No. PHO</label>
                        <input type="text" name="no_pho" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal PHO</label>
                        <input type="date" name="tgl_pho" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Keterangan PHO</label>
                        <textarea class="form-control" name="ket_pho" rows="5" required="" ></textarea>
                    </div>
                    <!--  -->
                </div>
                <!-- END four Step -->

                <!-- five Step -->
                <div id="clickable-five" class="step">
                    <!-- Step Info -->
                    <div class="form-group">
                        <div class="col-xs-12">
                            <ul class="nav nav-pills nav-justified clickable-steps">
                                <li><a href="javascript:void(0)" data-gotostep="clickable-first"><i class="fa fa-map-marker"></i> <strong>Peta</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-second"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-third"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                <li><a href="javascript:void(0)" data-gotostep="clickable-four"><i class="fa fa-sticky-note"></i> <strong>SHO</strong></a></li>
                                <li class="active"><a href="javascript:void(0)" data-gotostep="clickable-five"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Step Info -->
                    
                    <div class="form-group">
                        <label>No. BAST</label>
                        <input type="text" name="no_bast" class="form-control" maxlength="191" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal BAST</label>
                        <input type="date" name="tgl_bast" class="form-control" required="">
                    </div>
                    <div class="form-group">
                        <label>Keterangan BAST</label>
                        <textarea class="form-control" name="ket_bast" rows="5" required="" ></textarea>
                    </div>
                    <!--  -->
                </div>
                <!-- END five Step -->

                <!-- Form Buttons -->
                <div class="form-group form-actions">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="reset" class="btn btn-effect-ripple btn-danger" id="back1"><i class="fa fa-arrow-circle-left"></i> Kembali</button>
                        <button type="submit" class="btn btn-effect-ripple btn-primary" id="next1">Selanjutnya <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                </div>
                <!-- END Form Buttons -->
                {{csrf_field()}}
            </form>
            <!-- END Clickable Wizard Content -->

                            </div>
                        </div>
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
<!-- END Get Started Block -->
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGsxcGOZ82-QA1VoN4Iqb-eBaSXPqKsmY&callback=initMap&libraries=places" async defer></script>
<!-- Load and execute javascript code used only in this page -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/i18n/af.js"></script>
<script src="/vendor/laravel-filemanager/js/lfm.js"></script>
<script src="/admin/js/pages/formsWizard.js"></script>
<script>$(function(){ FormsWizard.init(); });</script>
<script type="text/javascript">
    var defaultPosition = {lat: -0.026779173829702012, lng: 109.34211730957031};
    $(function () {
        document.getElementById("x").value = defaultPosition.lat;
        document.getElementById("y").value = defaultPosition.lng;
        $('.select2').select2();
        $('#lfm').filemanager('file');
    });
</script>
<script type="text/javascript">
    var map;
    var markers = [];

    function deleteMarkers() {
      clearMarkers();
      markers;
    }

    function clearMarkers() {
      setMapOnAll(null);
    }

    function setMapOnAll(map) {
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
      }
    }

    function addMarker(latLng) {
      deleteMarkers();
      var marker = new google.maps.Marker({
        position: latLng,
        map: map,
        draggable: true
      });
      markers.push(marker);
      $("#x").val(latLng.lat());
      $("#y").val(latLng.lng());
      google.maps.event.addListener(marker, 'position_changed', function (event) {
        document.getElementById("x").value = this.getPosition().lat();
        document.getElementById("y").value = this.getPosition().lng();
      });
    }

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: defaultPosition,
        zoom: 12,
      });

      map.addListener('click', function(event) {
        addMarker(event.latLng);
      });

      // Create the search box and link it to the UI element.
      var input = document.getElementById('caripeta');
      var searchBox = new google.maps.places.SearchBox(input);
      map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      // Bias the SearchBox results towards current map's viewport.
      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];
      // Listen for the event fired when the user selects a prediction and retrieve
      // more details for that place.
      searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
              return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }
              var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
              };

              // Create a marker for each place.
              markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                title: place.name,
                position: place.geometry.location
              }));

              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                bounds.extend(place.geometry.location);
              }
            });
            map.fitBounds(bounds);
          });
      
    }

    $('#daerahs_id').change(function(){
        var id = $(this).val();
           $.ajax({
                  type:"GET",
                  url: "/api/cari-daerah/"+id,
                  dataType: 'json',
                  cache: false,
                  success: function(msg){
                      var point = {lat: parseFloat(msg.x), lng: parseFloat(msg.y)};
                      $("#x").val(point.lat);
                      $("#y").val(point.lng);
                      map.setCenter(point);
                      map.setZoom(10);
                  }
              });
        var teks = $("#daerahs_id option[value="+id+"]").text();
        $('form input[name=kab_kota]').val(teks);
    });
    // google.maps.event.addListenerOnce(map, 'idle', function(){
        // do something only the first time the map is loaded
    // });
</script>
@endpush