@extends('layouts.admin.main')

@section('seo-title')
Peta
@endsection

@section('title')
<span class="gi gi-google_maps"></span> PETA
@endsection

@push('css')
<style type="text/css">
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
	<div class="block full">
	    <!-- Get Started Title -->
	    <div class="block-title">
	        	<h2>Legenda</h2>
	    </div>
	    <!-- END Get Started Title -->
        <div class="row">
            @foreach($kategoris as $kategori)
                <div class="col-md-2" style="padding-top: 10px;">
                    <img src="{{$kategori->icon}}" height="35" width="26">
                    <label>
                        {{$kategori->nama}}
                        <input id="k{{$kategori->id}}" type="checkbox" checked>
                    </label>
                </div>
            @endforeach
        </div>
	    <!-- Get Started Content -->
	    <!-- END Get Started Content -->
	</div>
<div id="modal">
	
</div>	
	<div class="block full">
	    <!-- Get Started Title -->
	    <div class="block-title">
	        <h2>Peta</h2>
	    </div>
	    <!-- END Get Started Title -->

	    <!-- Get Started Content -->
	    	<div class="form-control" id="map" style="width: 100%;height: 500px;"></div>	    	
	    <!-- END Get Started Content -->
	</div>
<!-- END Get Started Block -->
@endsection

@push('js')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGsxcGOZ82-QA1VoN4Iqb-eBaSXPqKsmY&callback=initMap" async defer></script>
<!-- <script type="text/javascript" src="/js/markerwithlabel_packed.js"></script> -->
<script type="text/javascript">
	var map;
    var markers = [];
    var infowindows = [];
    var myLatLng;

    function popitup(url,windowName) {
           newwindow=window.open(url,windowName,'height=1000,width=1000');
           if (window.focus) {newwindow.focus()}
           return false;
         }

	function load_marker(map) {
		$.ajax({
			type:"GET",
	        url: "/api/semua-data",
	        dataType: 'json',
	        cache: false,
	        success: function(msg){
	        	console.log(msg);
	        	for(i=0;i<msg.length;i++) {

                	var point = new google.maps.LatLng(parseFloat(msg[i].x),parseFloat(msg[i].y));
                	
                	markers[i] = new google.maps.Marker({
	                    position: point,
                        icon: msg[i].kategori.icon,
						draggable: false,
						visible: true,
	                    map: map
	                });

	        		console.log(markers[i]);

	                var content = '<div id="iw-container">' +
				                    '<div class="iw-title">Detail Info</div>' +
				                    '<div class="iw-content">' +
				                      '<div class="iw-subTitle"><u>'+msg[i].judul_pekerjaan+'</u></div>' +
				                          '<p>'+
				                                'Lokasi : '+msg[i].lokasi+'<br>'+
				                                'Perusahaan : '+msg[i].nama_pr+
				                                '<table id="iw-table">'+
				                                    '<tr>'+
				                                        '<td><b>Tanggal SPK</b></td> <td>:</td> <td>'+msg[i].tgl_spk+'</td>'+
				                                        '<td></td>'+
				                                        '<td><b>Tanggal Adendum</b></td> <td>:</td> <td>'+msg[i].tgl_adendum+'</td>'+
				                                    '</tr>'+
				                                    '<tr>'+
				                                        '<td><b>No. SPK</b></td> <td>:</td> <td>'+msg[i].no_spk+'</td>'+
				                                        '<td></td>'+
				                                        '<td><b>No. Adendum</b></td> <td>:</td> <td>'+msg[i].no_adendum+'</td>'+
				                                    '</tr>'+
				                                    '<tr>'+
				                                        '<td><b>Pagu Anggaran</b></td> <td>:</td> <td>'+msg[i].pagu+'</td>'+
				                                        '<td></td>'+
				                                        '<td><b>Nilai Anggaran</b></td> <td>:</td> <td>'+msg[i].nilai+'</td>'+
				                                    '</tr>'+
				                                    '<tr>'+
				                                        '<td><b>Sisa Anggaran</b></td> <td>:</td> <td>'+msg[i].sisa+'</td>'+
				                                        '<td></td>'+
				                                        '<td><b>Persentase Anggaran</b></td> <td>:</td> <td>'+msg[i].persen+' %</td>'+
				                                    '</tr>'+
				                                '</table>'+
				                          '</p>' +
				                    '</div>' +
				                    '<div class="iw-bottom-gradient"></div>' +
				                  '</div>';

	                infowindows[i] = new google.maps.InfoWindow({
					    content: content
					});
					showTooltip(markers[i],map,i,msg[i].id);
	        	}
	        }
	    });
	}

	function showTooltip(marker, map,i,id) {

	  // This event expects a click on a marker
      // When this event is fired the Info Window is opened.
      google.maps.event.addListener(marker, 'mouseover', function() {
        infowindows[i].open(map,marker);
      });

      // Event that closes the Info Window with a click on the map
      google.maps.event.addListener(map, 'click', function() {
        infowindows[i].close();
      });

      google.maps.event.addListener(marker, 'click', function() {
        var url = 'http://pekerjaanumum.itkonsultan.id/admin/data/'+id;
        popitup(url,'DATA');
      });

      // *
      // START INFOWINDOW CUSTOMIZE.
      // The google.maps.event.addListener() event expects
      // the creation of the infowindow HTML structure 'domready'
      // and before the opening of the infowindow, defined styles are applied.
      // *
      google.maps.event.addListener(infowindows[i], 'domready', function() {

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
                  $(this).close();
                });
        });	
	}

    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -0.10814501846297607, lng: 109.3182775878906},
        zoom: 7,
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
	  load_marker(map);
    }

    @foreach($kategoris as $kategori)
        $('#k{{$kategori->id}}').click(function(){
    		if (document.getElementById($(this).attr("id")).checked){
    			for (i=0; i<markers.length; i++) {
                    if (markers[i].icon=="{{$kategori->icon}}" || markers[i].icon=="{{$kategori->icon_ex}}") {
                        markers[i].setVisible(true);
                    }
    			}
    		}
    		else{
    			for (i=0; i<markers.length; i++) {
    				if (markers[i].icon=="{{$kategori->icon}}" || markers[i].icon=="{{$kategori->icon_ex}}") {
                        markers[i].setVisible(false);
                    }
    			}
    		}		
        });
    @endforeach
</script>
@endpush