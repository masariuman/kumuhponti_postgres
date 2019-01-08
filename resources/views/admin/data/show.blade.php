@extends('layouts.admin.main')

@section('seo-title')
Data
@endsection

@section('title')
<span class="gi gi-compass"></span> DATA
@endsection

@push('css')
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
    #peta{
        margin-top: 100px;
    }

    #map-canvas {
    margin: 0;
    padding: 0;
    height: 400px;
    max-width: none;
}
#map-canvas img {
    max-width: none !important;
}
.gm-style-iw {
    width: 350px !important;
    top: 15px !important;
    left: 0px !important;
    background-color: #fff;
    box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
    border: 1px solid rgba(72, 181, 233, 0.6);
    border-radius: 2px 2px 10px 10px;
}
#iw-container {
    margin-bottom: 10px;
}
#iw-container .iw-title {
    font-family: 'Open Sans Condensed', sans-serif;
    font-size: 22px;
    font-weight: 400;
    padding: 10px;
    background-color: #48b5e9;
    color: white;
    margin: 0;
    border-radius: 2px 2px 0 0;
}
#iw-container .iw-content {
    font-size: 13px;
    line-height: 18px;
    font-weight: 400;
    margin-right: 1px;
    padding: 1px;
    max-height: 140px;
    overflow-y: auto;
    overflow-x: hidden;
}
.iw-content img {
    float: right;
    margin: 0 5px 5px 10px; 
}
.iw-content p {
    text-align: center;
}
.iw-subTitle {
    font-size: 16px;
    font-weight: 700;
    padding: 5px 0;
    text-align: center;
}
.iw-bottom-gradient {
    position: absolute;
    width: 326px;
    height: 25px;
    bottom: 10px;
    right: 18px;
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 100%);
}
#iw-table {
    margin-top: -20px;
}
#iw-table td{
    padding: 5px;
}
</style>
@endpush

@section('main')

<!-- Get Started Block -->
        <!-- Get Started Content -->
                        <div class="block full">
                            <div class="block-title">
                                <h2>Detail Data</h2>
                            </div>
                            <div class="container-fluid" style="padding-top: 10px;">
            
            <!-- Peta -->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-xs-6">
                                        <label>Latitude</label>
                                        <input id="x" type="number" id="x" name="x" class="form-control" step="any" max="999" value="-0.15814501846297607" disabled>   
                                    </div>
                                    <div class="col-xs-6">
                                        <label>Longitude</label>
                                        <input id="y" type="number" id="y" name="y" class="form-control" step="any" max="999" value="109.4182775878906" disabled>
                                    </div>
                                </div>
                                <div class="form-group" id="peta" style="min-height: 420px;">
                                    <div class="form-control" style="min-height: 420px;">
                                        <input id="caripeta" class="controlcaripeta" type="text" placeholder="Cari Lokasi Disini..">
                                        <div id="map-canvas" style="min-height: 400px;">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            <!-- Peta -->

            <!-- Tabs Block -->
                        <div class="block">

                            <!-- Tabs Title -->
                            <div class="block-title">
                                <ul class="nav nav-tabs" data-toggle="tabs">
                                    <li class="active"><a href="#info"><i class="fa fa-info-circle"></i> <strong>Info</strong></a></li>
                                    <li><a href="#perusahaan"><i class="fa fa-list-alt"></i> <strong>Perusahaan</strong></a></li>
                                    <li><a href="#pho"><i class="fa fa-sticky-note"></i> <strong>PHO</strong></a></li>
                                    <li><a href="#bast"><i class="fa fa-sticky-note-o"></i> <strong>BAST</strong></a></li>
                                </ul>
                            </div>
                            <!-- END Search Styles Title -->

                            <!-- Tabs Content -->
                            <div class="tab-content">

                                <!-- info-->
                                <div class="tab-pane active" id="info">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>No.SPK</label>
                                            <input type="text" name="no_spk" disabled class="form-control" maxlength="191" value="{{$datas->no_spk}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal SPK</label>
                                            <input type="date" name="tgl_spk" class="form-control" disabled="" value="{{$datas->tgl_spk}}">
                                        </div>
                                        <div class="form-group">
                                            <label>No. Adendum</label>
                                            <input type="text" name="no_adendum" class="form-control" maxlength="191" disabled="" value="{{$datas->no_adendum}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Adendum</label>
                                            <input type="date" name="tgl_adendum" class="form-control" disabled="" value="{{$datas->tgl_adendum}}">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Judul Pekerjaan</label>
                                            <input type="text" name="judul_pekerjaan" class="form-control" maxlength="191" disabled="" value="{{$datas->judul_pekerjaan}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <input type="number" name="volume" class="form-control" min="0" value="0" disabled="" value="{{$datas->volume}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" name="lokasi" class="form-control" maxlength="191" disabled="" value="{{$datas->lokasi}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Kabupaten/Kota</label>
                                            <input type="text" name="kab_kota" class="form-control" maxlength="191" disabled="" value="{{$datas->kab_kota}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Pagu Anggaran</label>
                                            <input type="number" name="pagu" class="form-control" min="0" value="0" disabled="" value="{{$datas->pagu}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nilai Anggaran</label>
                                            <input type="number" name="nilai" class="form-control" min="0" value="0" disabled="" value="{{$datas->nilai}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Sisa Anggaran</label>
                                            <input type="number" name="sisa" class="form-control" min="0" value="0" disabled="" value="{{$datas->sisa}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Persentase</label>
                                            <input type="number" name="persen" class="form-control" min="0" max="100" value="0" disabled="" value="{{$datas->persentase}}">
                                        </div>
                                    </div>
                                </div>
                    
                                <!-- perusahaan -->
                                <div class="tab-pane" id="perusahaan">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>Nama Perusahaan</label>
                                            <input type="text" name="nama_pr" class="form-control" maxlength="191" disabled="" value="{{$datas->nama_pr}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat Perusahaan</label>
                                            <input type="text" name="alamat_pr" class="form-control" maxlength="191" disabled="" value="{{$datas->alamat_pr}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Direktur</label>
                                            <input type="text" name="direktur" class="form-control" maxlength="191" disabled="" value="{{$datas->direktur}}">
                                        </div>
                                    </div>
                                </div>

                                <!-- pho -->
                                <div class="tab-pane" id="pho">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>No. PHO</label>
                                            <input type="text" name="no_pho" class="form-control" maxlength="191" disabled="" value="{{$datas->no_pho}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal PHO</label>
                                            <input type="date" name="tgl_pho" class="form-control" disabled="" value="{{$datas->tgl_pho}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan PHO</label>
                                            <textarea class="form-control" name="ket_pho" rows="5" disabled="" >{{$datas->ket_pho}}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- bast -->
                                <div class="tab-pane" id="bast">
                                    <div class="row">
                                        <div class="form-group">
                                            <label>No. BAST</label>
                                            <input type="text" name="no_bast" class="form-control" maxlength="191" disabled="" value="{{$datas->no_bast}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal BAST</label>
                                            <input type="date" name="tgl_bast" class="form-control" disabled="" value="{{$datas->tgl_bast}}">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan BAST</label>
                                            <textarea class="form-control" name="ket_bast" rows="5" disabled="" >{{$datas->ket_bast}}</textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Tabs Content -->
                        </div>
            <!-- Tabs Block -->

                            </div>
                        </div>
<!-- END Get Started Block -->
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGsxcGOZ82-QA1VoN4Iqb-eBaSXPqKsmY&callback=initMap&libraries=places" async defer></script>
<!-- Load and execute javascript code used only in this page -->
<script src="/admin/js/pages/formsWizard.js"></script>
<script>$(function(){ FormsWizard.init(); });</script>

<script type="text/javascript">
    var map;
    var latEdit = {{ $datas->x }};
    var lngEdit = {{ $datas->y }};
    var editPosition = {lat: latEdit, lng: lngEdit}; //posisi berkah properti
    var markers = [];
    var marker;

    function addMarker(latLng) {
        var content = '<div id="iw-container">' +
                    '<div class="iw-title">Detail Info</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle"><u>{{$datas->judul_pekerjaan}}</u></div>' +
                          '<p>'+
                                'Lokasi : {{$datas->lokasi}}<br>'+
                                'Perusahaan : {{$datas->nama_pr}}'+
                                '<table id="iw-table">'+
                                    '<tr>'+
                                        '<td><b>Tanggal SPK</b></td> <td>:</td> <td>{{$datas->tgl_spk}}</td>'+
                                        '<td></td>'+
                                        '<td><b>Tanggal Adendum</b></td> <td>:</td> <td>{{$datas->tgl_adendum}}</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>No. SPK</b></td> <td>:</td> <td>{{$datas->no_spk}}</td>'+
                                        '<td></td>'+
                                        '<td><b>No. Adendum</b></td> <td>:</td> <td>{{$datas->no_adendum}}</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Pagu Anggaran</b></td> <td>:</td> <td>{{$datas->pagu}}</td>'+
                                        '<td></td>'+
                                        '<td><b>Nilai Anggaran</b></td> <td>:</td> <td>{{$datas->nilai}}</td>'+
                                    '</tr>'+
                                    '<tr>'+
                                        '<td><b>Sisa Anggaran</b></td> <td>:</td> <td>{{$datas->sisa}}</td>'+
                                        '<td></td>'+
                                        '<td><b>Persentase Anggaran</b></td> <td>:</td> <td>{{$datas->persen}}%</td>'+
                                    '</tr>'+
                                '</table>'+
                          '</p>' +
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>';

        var infowindow = new google.maps.InfoWindow({
          content: content
        });
        marker = new google.maps.Marker({
            position: latLng,
            icon: '{{$datas->kategori->icon}}',
            map: map,
            draggable: false,
        });

       // This event expects a click on a marker
      // When this event is fired the Info Window is opened.
      google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
      });

      // Event that closes the Info Window with a click on the map
      google.maps.event.addListener(map, 'click', function() {
        infowindow.close();
      });

      // *
      // START INFOWINDOW CUSTOMIZE.
      // The google.maps.event.addListener() event expects
      // the creation of the infowindow HTML structure 'domready'
      // and before the opening of the infowindow, defined styles are applied.
      // *
        google.maps.event.addListener(infowindow, 'domready', function() {

                // Reference to the DIV that wraps the bottom of infowindow
                var iwOuter = $('.gm-style-iw');

                /* Since this div is in a position prior to .gm-div style-iw.
                 * We use jQuery and create a iwBackground variable,
                 * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
                */
                var iwBackground = iwOuter.prev();

                // Removes background shadow DIV
                iwBackground.children(':nth-child(2)').css({'display' : 'none'});

                // Removes white background DIV
                iwBackground.children(':nth-child(4)').css({'display' : 'none'});

                // Moves the infowindow 115px to the right.
                iwOuter.parent().parent().css({left: '115px'});

                // Moves the shadow of the arrow 76px to the left margin.
                iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                // Moves the arrow 76px to the left margin.
                iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

                // Changes the desired tail shadow color.
                iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

                // Reference to the div that groups the close button elements.
                var iwCloseBtn = iwOuter.next();

                // Apply the desired effect to the close button
                iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

                // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
                if($('.iw-content').height() < 140){
                  $('.iw-bottom-gradient').css({display: 'none'});
                }

                // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
                iwCloseBtn.mouseout(function(){
                  $(this).css({opacity: '1'});
                });
        });

        markers.push(marker);
    }

    function initMap() {
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: editPosition,
            zoom: 17,
        });

        map.addListener('load', addMarker(editPosition));

        // Create the search box and link it to the UI element.
        var input = document.getElementById('caripeta');
        var restore = document.getElementById('restore');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(restore);

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
</script>

<script type="text/javascript">
    $(function () {
    });
</script>
@endpush