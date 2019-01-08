@extends('layouts.admin.main')

@section('seo-title')
History Data
@endsection

@section('title')
<span class="gi gi-compass"></span> @yield('seo-title')
@endsection

@push('css')
 <style>
      .controls {
        margin-top: 10px;
        border: 1px solid transparent;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        height: 32px;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
      }

      #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        margin-left: 0px;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 300px;
      }

      #pac-input:focus {
        border-color: #4d90fe;
      }

      .pac-container {
        font-family: Roboto;
      }

      #type-selector {
        color: #fff;
        background-color: #4d90fe;
        padding: 5px 11px 0px 11px;
      }

      #type-selector label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
      }
      #target {
        width: 345px;
      }
    </style>
@endpush

@section('main')

<!-- Get Started Block -->
<div class="block full">
	    <!-- Get Started Content -->
	    	<!-- Datatables Block -->
<form enctype="multipart/form-data" method="POST" onsubmit="return kosong()" action="{{ route('history.restore') }}">
<input type="hidden" name="id" value="{{$data->id}}">
<input type="hidden" name="kategori_update" value="{{$data->kategori_update}}">
{{ csrf_field() }}

@php($str_data = '{"zoom":7,"tilt":0,"mapTypeId":"hybrid","center":{"lat":-0.0352232,"lng":109.2613377},"overlays":[]}')

                        <div class="block full">
                            <div class="block-title">
                                <h2>@yield('seo-title')</h2>
                            </div>
                            <div class="row">
                              <div class="col-md-12" style="height: 40px;">
                                <a type="button" href="{{ URL::previous() }}" class="btn btn-effect-ripple btn-danger pull-left"> <i class="fa fa-arrow-left"></i> Kembali</a>&nbsp;&nbsp;
                                <!-- <button id="save_data" type="submit" class="btn btn-effect-ripple btn-success pull-right"> <i class="fa fa-save"></i> Simpan Data</button>  -->
                                <button id="save_data" type="submit" class="btn btn-effect-ripple btn-success pull-right"> <i class="fa fa-save"></i> Kembalikan Data</button> 
                                <!-- <button id="shapefile" type="submit" class="btn btn-effect-ripple btn-success"> <i class="fa fa-save"></i> Ekspor ke SHP</button> -->
                              </div>
                              <div class="col-md-6">
                                 <div class="desc"><b>
                                 	<table>
                                 		<tr>
                                 			<td>
                                 				Lokasi
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				{{ $data->lokasi }}
                                 			</td>
                                 		</tr>
                                 		<tr>
                                 			<td>
                                 				Kecamatan
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				{{ $data->kecamatan }}
                                 			</td>
                                 		</tr>
                                 		<tr>
                                 			<td>
                                 				Kelurahan
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				{{ $data->kelurahan }}
                                 			</td>
                                 		</tr>
                                 		<tr>
                                 			<td>
                                 				Status
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				{{ $data->status }}
                                 			</td>
                                 		</tr>
                                 		<tr>
                                 			<td>
                                 				Last Updated By
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				{{ $data->user->name }}
                                 			</td>
                                 		</tr>
                                 		<tr>
                                 			<td>
                                 				Original Work By
                                 			</td>
                                 			<td style="padding-left: 10px; padding-right: 10px;">
                                 				:
                                 			</td>
                                 			<td>
                                 				@foreach($original as $ori)
                                 					{{ $ori->user->name }}
                                 				@endforeach
                                 			</td>
                                 		</tr>
                                    <tr>
                                      <td>
                                        Luas
                                      </td>
                                      <td style="padding-left: 10px; padding-right: 10px;">
                                        :
                                      </td>
                                      <td>
                                        <div id="luass">{{ $data->luas }}</div>
                                      </td>
                                    </tr>
                                 	</table></b>
                                </div>
                                <!-- <div class="form-group">
                                  <input id="pac-input" onkeypress="return runScript(event)" class="controls" type="text" placeholder="Cari Lokasi Disini...">
                                </div>  -->  
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <!-- user -->
                                    <!-- button hidden -->
                                    <input class="hidden" type="button" value="Generate KML" onclick="BlitzMap.toKML()" />
                                    <input class="hidden" type="button" value="parse KML to map" onclick="BlitzMap.setMapFromKML(document.getElementById('kmlString').value)" />
                                    <input class="hidden" id="generate_text" type="button" value="Generate Map Text" onclick="BlitzMap.toJSONString()" />
                                    <!-- button hidden -->
                                    <!-- <input type="button" value="generate polygon from encoded" onclick="BlitzMap.setMapFromEncoded(document.getElementById('encodedData').value);" />  -->
                                    <!-- <textarea id="encodedData" style="width:100%; /* height: 100px; */">aq|rFttwdQiizCfl}AqcbFfxv@_jfBff}@silAdfdDl`UzrlCmpp@z~eBgq@rrz`@~_dK?rfBstgK~daE~eBbwDulch@</textarea> -->
                                    <textarea class="hidden" id="mapData" style="width:100%; height:300px" name="data">{!! (empty($data->data)) ? $str_data : $data->data !!}</textarea>
                                    <textarea class="hidden" id="kmlString" style="width:100%; height:500px"></textarea>
                                </div>
                                <div class="form-group">
                                	<input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                </div>
                                                             
                              </div>
                              <div class="col-md-12">
                                <div id="myMap" style="height:400px; width:100%;"></div>
                              </div>
                            </div>
                        </div>
                        <!-- END Datatables Block -->
	    <!-- END Get Started Content -->
</form>
<!-- <button id="shapefile" type="submit" class="btn btn-effect-ripple btn-success"> <i class="fa fa-save"></i> Ekspor ke SHP</button> -->

</div>
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

<script type="text/javascript" src ="/js2shapefile/lib/FileSaveTools.js"></script>
<script type="text/javascript" src="/js2shapefile/src/JS2Shapefile.js"></script>

<script type="text/javascript">
        var map = BlitzMap.setMap( 'myMap', false, 'mapData' );
        
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



   //      	$('#generate_text').trigger('click');
   //         // alert($('#mapData').text());


           

			// var valid = document.getElementById("mapData").value;

			// if(isEmpty(valid.overlays)) {
			//     // console.log('kosong');
			//     return false;
			// } else {
			//     // console.log('tidak');
			// }
   //      }


        $('#save_data').click(function(){
           // alert('work');
           $('#generate_text').trigger('click');
           // alert($('#mapData').text());


        
   //         function isEmpty(obj) {
			//     for(var key in obj) {
			//         if(obj.hasOwnProperty(key))
			//             return false;
			//     }
			//     return true;
			// }

			
			
				// if(isEmpty(valid.overlays)) {
				//     // console.log('kosong');
				//     return false;
				// }
			

        });


        function kosong(){
        	$('#generate_text').trigger('click');
        	var valid = document.getElementById("mapData").value;
        	var validation = JSON.parse( valid );
        	function isEmpty(obj) {
			    for(var key in obj) {
			        if(obj.hasOwnProperty(key))
			            return false;
			    }
			    return true;
			}
			// alert(valid);

			// var map = {"zoom":7,"tilt":0,"mapTypeId":"hybrid","center":{"lat":24.490520912178603,"lng":74.22363281640628},"overlays":[]};

			// var polygon = {"zoom":7,"tilt":0,"mapTypeId":"hybrid","center":{"lat":20.487486793750797,"lng":74.22363281640628},"overlays":[{"type":"polygon","title":"","content":"","fillColor":"#000000","fillOpacity":0.3,"strokeColor":"#000000","strokeOpacity":0.9,"strokeWeight":3,"paths":[[{"lat":"21.329035778926478","lng":"73.46008301171878"},{"lat":"21.40065516914794","lng":"78.30505371484378"},{"lat":"20.106233605369603","lng":"77.37121582421878"},{"lat":"20.14749530904506","lng":"72.65808105859378"}]]}]};

        	if(isEmpty(validation.overlays)) {
				    // console.log('kosong');

				    alert("GAMBAR TIDAK BOLEH KOSONG");
				    return false;
				} else {
					return true;
				}
        }



        $('#shapefile').click(function()
        {

          // alert('work');
          $('#generate_text').trigger('click');
          // alert($('#mapData').text());
          var mapStorageId = document.getElementById("mapData").value;
          // alert(mapStorageId);
          setMapData( mapStorageId  );

          function setMapData( jsonString ){
            // if( typeof jsonString == 'undefined' || jsonString.length == 0 ){
            //   return false;
            // }
            // var tete = jsonString;
            // alert(tete);
            var inputData = JSON.parse( jsonString );
            // alert(inputData.type);
            // alert(JSON.stringify(inputData));
            // alert(inputData.overlays.type);
            // alert(JSON.stringify(entry));

		        // if( inputData.zoom ){
		        //     mapObj.setZoom( inputData.zoom );
		        // }else{
		        //     mapObj.setZoom( 10 );
		        // }

		        // if( inputData.tilt ){
		        //     mapObj.setTilt( inputData.tilt );
		        // }else{
		        //     mapObj.setTilt( 0 );
		        // }

		        // if( inputData.mapTypeId ){
		        //     mapObj.setMapTypeId( inputData.mapTypeId );
		        // }else{
		        //     mapObj.setMapTypeId( "hybrid" );
		        // }

		        // if( inputData.center ){
		        //     mapObj.setCenter( new google.maps.LatLng( inputData.center.lat, inputData.center.lng ) );
		        // }else{
		        //     mapObj.setCenter( new google.maps.LatLng( 19.006295, 73.309021 ) );
		        // }

            // alert(inputData.overlays.length);

		        var tmpOverlay, ovrOptions;
		        var graphicArray = [];
		        var properties = new Array( 'fillColor', 'fillOpacity', 'strokeColor', 'strokeOpacity','strokeWeight', 'icon');


		        for( var m = inputData.overlays.length-1; m >= 0; m-- ){
              // ovrOptions = new Object();

              // for( var x=properties.length; x>=0; x-- ){
              //   if( inputData.overlays[m][ properties[x] ] ){
              //     ovrOptions[ properties[x] ] = inputData.overlays[m][ properties[x] ];
              //   }
              // }

              // var tipe;
              // for (var k in inputData){
              //   if(k ==  "overlays")
              //   {
              //     var entry = inputData[k];
              //     alert(entry[0].type);
              //   }                           
              // }


                    if( inputData.overlays[m].type == "polygon" ){
                      // alert('work');
                      var rings = [];
                      // var cincin = [];
                      for (var j = 0; j < inputData.overlays[m].paths.length; j++) {
                        var ring = [];
                        for (var k = 0; k < inputData.overlays[m].paths[j].length; k++) {
                          var point = inputData.overlays[m].paths[j][k];
                          ring.push([point.lng, point.lat]);
                        }
                        rings.push(ring);
                      }
                      // alert(ring);
                      // alert(cincin);
                      // rings.push(rings);
                      // alert(rings);

                      // alert(inputData.overlays[m].title);
                      var type = "polygon";
                      var Nama_Lokasi = inputData.overlays[m].title;
                      var Deskripsi = inputData.overlays[m].content;
                      var geometry = {rings, type};
                      // alert(JSON.stringify(geometry));
                      var attributes = {};
                      attributes["Lokasi"] = Nama_Lokasi;
                      attributes["Deskripsi"] = Deskripsi;
                      var graphic = {geometry, attributes};
                      graphicArray.push(graphic);
                      // alert(graphicArray);
                      // alert(JSON.stringify(graphic));
                      // alert(JSON.stringify(graphicArray));

                    }else if( inputData.overlays[m].type == "polyline" ){
                      // alert('work');

                      var paths =[];
                      var path = [];
                      for (var j = 0; j < inputData.overlays[m].path.length; j++) {
                          var point = inputData.overlays[m].path[j];
                          path.push([point.lng, point.lat]);
                      }
                      // alert(path);
                      paths.push(path);
                      // alert(paths);


                      // alert(inputData.overlays[m].title);
                      var type = "polyline";
                      var Nama_Lokasi = inputData.overlays[m].title;
                      var Deskripsi = inputData.overlays[m].content;
                      var geometry = {paths, type};
                      var attributes = {};
                      attributes["Lokasi"] = Nama_Lokasi;
                      attributes["Deskripsi"] = Deskripsi;
                      var graphic = {geometry, attributes};
                      graphicArray.push(graphic);
                      // alert(graphicArray);
                      // alert(JSON.stringify(graphicArray));

                    }else if( inputData.overlays[m].type == "marker" ){
                      var x = inputData.overlays[m].position.lng;
                      var y = inputData.overlays[m].position.lat;
                      var type = "point";
                      var Nama_Lokasi = inputData.overlays[m].title;
                      var Deskripsi = inputData.overlays[m].content;
                      var geometry = {x,y,type};
                      var attributes = {};
                      attributes["Lokasi"] = Nama_Lokasi;
                      attributes["Deskripsi"] = Deskripsi;
                      var graphic = {geometry, attributes};
                      graphicArray.push(graphic);
                      // alert(JSON.stringify(graphicArray));
                  }
            }

            var shapewriter = new Shapefile();
            shapewriter.addESRIGraphics(graphicArray);
            var outputObject = {
              points: shapewriter.getShapefile("POINT"),
              lines: shapewriter.getShapefile("POLYLINE"),
              polygons: shapewriter.getShapefile("POLYGON")
            }
            var saver = new BinaryHelper();
            var anythingToDo = false;
            for (var shapefiletype in outputObject){
              if (outputObject.hasOwnProperty(shapefiletype)){
                if (outputObject[shapefiletype]['successful']){
                  anythingToDo = true;
                  for (actualfile in outputObject[shapefiletype]['shapefile']){
                    if (outputObject[shapefiletype]['shapefile'].hasOwnProperty(actualfile)){
                      saver.addData({
                        filename: "Data_"+shapefiletype+"_Digitasi_online",
                        extension: actualfile,
                        datablob: outputObject[shapefiletype]['shapefile'][actualfile]
                      });
                    }
                  }
                }
              }
            }

            if (anythingToDo) {
              var btn = saver.createSaveControl("saveButtonDiv");
            }else {
              alert('Tidak ada Digitasi yang Dilakukan');
            }
            // $('#kelik').trigger('click');
            // $('#saveButtonDiv').click();

            // $('#saveButtonDiv').click(function(e){
            //   if($(e.target).is('object')) return;
            //   $(this).find('object').click();
            // });

            // $('#saveButtonDiv').click(function() {
                // $(#saveButtonDiv).find(object);
                // objt.trigger('click');
            // });

            // $( '[id^="downloadify_*"]' ).click();



          }

           // alert($('#mapData').text());


        });


</script>
@endpush