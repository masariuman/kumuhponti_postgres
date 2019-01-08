
var map;
var markers = [];
var infowindows = [];
var measureTool;
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
            // console.log(msg);
            for(i=0;i<msg.length;i++) {

                var point = new google.maps.LatLng(parseFloat(msg[i].x),parseFloat(msg[i].y));
                
                markers[i] = new google.maps.Marker({
                    position: point,
                    icon: msg[i].kategori.icon,
                    draggable: false,
                    visible: true,
                    map: map
                });

                // console.log(markers[i]);

                var content = '<div id="iw-container">' +
                                '<div class="iw-title">'+msg[i].nama_pr+'</div>' +
                                '<div class="iw-content">' +
                                  '<div class="iw-subTitle"><u>'+msg[i].judul_pekerjaan+'</u></div>' +
                                      '<p>'+
                                            'Lokasi : '+msg[i].lokasi+'<br>'+
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

  google.maps.event.addListener(marker, 'click', function() {
        var url = 'http://pekerjaanumum.itkonsultan.id/admin/data/'+id;
        popitup(url,'DATA');
  });

  // Event that closes the Info Window with a click on the map
  google.maps.event.addListener(map, 'click', function() {
    infowindows[i].close();
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
            });
    }); 
}

function initialize() {

    //Map parametrs
    var mapOptions = {
        zoom: 13,
        center: new google.maps.LatLng(-0.02014501846297607, 109.3182775878906),
        mapTypeId: google.maps.MapTypeId.HYBRID,

        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        panControl: false,
        panControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },

        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE,
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        scaleControl: false,
        scaleControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        },
        streetViewControl: true,
        streetViewControlOptions: {
            position: google.maps.ControlPosition.TOP_RIGHT
        }
    }

    //map
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    measureTool = new MeasureTool(map, {
              showSegmentLength: true,
              tooltip: true,
              unit: MeasureTool.UnitTypeId.METRIC // metric or imperial
            });
            measureTool.addListener('measure_start', () => {
              console.log('started');
        //      measureTool.removeListener('measure_start')
            });
            measureTool.addListener('measure_end', (e) => {
              console.log('ended', e.result);
        //      measureTool.removeListener('measure_end');
            });
            measureTool.addListener('measure_change', (e) => {
              console.log('changed', e.result);
        //      measureTool.removeListener('measure_change');
            });

    load_marker(map);
}