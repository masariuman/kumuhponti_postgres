@inject('tampilan', 'App\Http\Controllers\tampilanController')

<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCsbzuJDUEOoq-jS1HO-LUXW4qo0gW9FNs&libraries=drawing,geometry,places"></script>
        <title>{{$tampilan->data()->nama_aplikasi}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="keywords" content="{{$tampilan->data()->site_keyword}}" />
    <meta name="description" content="{{$tampilan->data()->site_desc}}">
    <meta name="author" content="Arif Setiawan">

    <link rel="shortcut icon" href="{{$tampilan->data()->favicon}}">


    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet" media="screen">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="css/whhg.css">

    <!-- Datatables -->
    <link href="https://cdn.datatables.net/responsive/2.1.0/css/responsive.dataTables.min.css" rel="stylesheet" media="screen">
    <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" media="screen">

    <link href="/pace/pace-theme-loading-bar.css" rel="stylesheet" media="screen">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">


<style type="text/css">
        .gm-style-iw {
    /*width: 350px !important;*/
    /*top: 15px !important;*/
    /*left: 0px !important;*/
    background-color: #fff;
    /*box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);*/
    /*border: 1px solid rgba(72, 181, 233, 0.6);*/
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
    margin-top: -5px;
}
#iw-table td{
    padding: 5px;
}

/*#table{
    font-size: 8px;
}*/
    </style>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]> <script src="../../assets/js/html5shiv.js"></script> <script src="../../assets/js/respond.min.js"></script> <![endif]-->
</head>
<body>
    {{-- <!--autorization modal-->
      <a href="#" class="btn btn-danger btn-sm btm-zindex none" id="Show_cont">Show content</a>
    <div class="modal fade" id="autorization">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Autorization</h4>
                </div>
                <div class="modal-body">
                    <form role="form">
                        <div class="form-group">
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" />
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" />
                                Check me out
                            </label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Sign in</button>
                    <button type="button" class="btn btn-primary btn-sm">Create account</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal --> --}}
    <!--map-->
    <!-- <div id="myMap"></div> -->
    <div id="myMap" class="map"></div>
    <!--/map-->
    <div class="row site">
        <div class="col-md-1 general_menu inner">
            <a href="/" class="avatar">
                <img src="img/globe_icon.png" alt="..."/></a>
            <ul>
                <li>
                    <a href="/" class="gradientmenu active"><i class="icon-map"></i></a>
                </li>
                <li>
                    <a href="#" class="gradientmenu"><i class="icon-map-marker"></i></a>
                </li>
                <li>
                    <a href="#" class="gradientmenu"><i class="icon-list-alt"></i></a>
                </li>
            </ul>
        </div>

        


        <!--Profile-->

        <div class="col-md-12 profile profile_closed" id="profile">
            <span class="close_span" id="open_span"><a href="#" class="close-profile-link clooses" id="link_open" style="font-size: 13px;"><i class="icon-info-sign"></i></a></span>
            {{-- <!--User info-->
            <div class="row">
                <div class="col-md-2">
                    <div class="user">

                        <img src="{{$tampilan->data()->logo_instansi}}" alt="{{ $tampilan->data()->nama_aplikasi }}" class="img-responsive" />
                    </div>
                </div>
                <div class="col-md-8 text-center">
                    <h2>{{$tampilan->data()->nama_instansi}}</h2>
                    <h2>{{$tampilan->data()->nama_aplikasi}}</h2>
                    <h2>{{$tampilan->data()->nama_pem}}</h2>
                </div>

                <div class="col-md-2">
                    <div class="user">
                        <img src="{{$tampilan->data()->logo_pem}}" alt="{{ $tampilan->data()->nama_aplikasi }}" class="img-responsive" />
                    </div>
                </div>
            </div>
            <!--/User info--> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="text-center" style="margin-bottom: 10px;"><img class="img-responsive" style="display: inline;" src="{{$tampilan->data()->logo_aplikasi}}" alt="{{$tampilan->data()->nama_aplikasi}}"/></div>
                    <div style="text-align: justify;">
                       {!! $tampilan->data()->tentang !!}
                    </div>
                </div>
            </div>
        </div>
        <!--/Profile-->
        <!--Content-->
        <div class="col-md-11 side-bar" id="cont">
            <!--header-->
            <div class="row">
                <div class="col-md-12 header">
                    <div class="logo">
                        <a href="/">
                            <img src="{{$tampilan->data()->logo_aplikasi}}" alt="{{$tampilan->data()->nama_aplikasi}}" style="margin-left: -30px; height: 30px;" class="img-responsive" /></a>
                    </div>
                </div>
            </div>
            <!--/header-->
             <!--Map open (for adaptive)-->
            <div class="row map_open">
                <div class="col-md-12">
                    <!-- <a href="#" id="map_open">Show map</a> -->
                </div>
            </div>
              <!--/Map open (for adaptive)-->
            <!--Category menu-->
            <div class="row">
                <div class="col-md-12">
                    <div id="tabs">
                        <div id="tab1" class="tab">

                        </div>
                        <div id="tab2" class="tab">
                            <textarea id="mapData" style="width:100%; height:300px" name="data" hidden="hidden">{{ $str_data }}</textarea>
                            <h5 class="cat">LAYER</h5>
                                    <form method="get" action="/filter">   
                                    {{ csrf_field() }} 
                                                                        
                                            <label>KECAMATAN</label>
                                            <ul class="catalog">
                                            
                                            @foreach($kecamatan as $key => $value)
                                                @if($key != '')
                                            <li>
                                                <a>
                                                    
                                                    <b style="margin-left: 10px;">
                                                    {{ $key }}
                                                    </b>
                                                    @if(isset($web))
                                                       <input class="pull-right" name="kecamatan[]" type="checkbox"  checked value="{{ $key }}">
                                                       <input type="hidden" id="web" value="{{$web}}">
                                                    @else
                                                        <input type="hidden" id="web" value="TIDAK ADA">
                                                        @if($array_kecamatan != null)
                                                            @if (in_array($key, $array_kecamatan))
                                                                <input class="pull-right" name="kecamatan[]" type="checkbox" checked value="{{ $key }}">
                                                            @else
                                                                <input class="pull-right" name="kecamatan[]" type="checkbox"  value="{{ $key }}">
                                                            @endif
                                                        @else
                                                            <input class="pull-right" name="kecamatan[]" type="checkbox"  value="{{ $key }}">
                                                        @endif
                                                    @endif 
                                                </a>
                                            </li>
                                                @endif
                                            @endforeach 
                                            </ul>
                                        <button type="submit" class="btn btn-primary pull-right">LIHAT</button>
                                    </form>
                        </div>
                        <div id="tab3" class="tab">

                        </div>
                    </div>
                </div>
            </div>
            <!--/Category menu-->
        </div>
        <div class="col-md-11 general_content_styles vcard" id="vcard">
            <!--header-->
            <div class="row">
                <div class="col-md-12 header">
                    <div class="logo">
                        <a href="/">
                            <img src="{{$tampilan->data()->logo_aplikasi}}" class="img-responsive" /></a>
                    </div>

                </div>
            </div>
            <!--/header-->
             <!--Map open (for adaptive)-->
            <div class="row map_open">
                <div class="col-md-12">
                    <!-- <a href="#" id="map_open">Show map</a> -->
                </div>
            </div>
              <!--/Map open (for adaptive)-->
            <div class="row">
                <div class="col-md-12 point_description">
                    <div class="row">
                        <div class="col-md-6">
                            <h2>TABEL DATA</h2>

                        </div>
                    </div>
                    <div class="row">                       
                        <div class="col-md-12 table-responsive">
                            <table id="tabel" class="display" cellspacing="0" width="100%" style="font-size: 10.5px;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: center;">Lokasi</th>
                                            <th style="text-align: center;">Kecamatan</th>
                                            <th style="text-align: center;">Kelurahan</th>
                                            <th style="text-align: center;">Luas</th>
                                            <th style="text-align: center;">Status</th>
                                            <th style="text-align: center;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($datas as $no => $data)
                                            <tr>
                                                <td>{{$data->nama_lokasi}}</td>
                                                <td style="text-align: center;">{{$data->kecamatan}}</td>
                                                <td style="text-align: center;">{{$data->lokasi_keg}}</td>
                                                <td style="text-align: center;">{{$data->luas}}</td>
                                                <td style="text-align: center;">{{$data->rencana}}</td>
                                                <td style="text-align: center;">
                                                    <button class="btn btn-xs btn-primary" onclick="LihatPeta({{$data->id}})" title="Lihat Peta"><i class="icon-map-marker"></i></button>
                                                </td>
                                                <td>{{ number_format($data->pagu,0) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td colspan="2"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/Content-->
    </div>

    <!-- Modal -->
    <div id="showup" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button id="zoom" type="button" style="visibility: hidden;" data-dismiss="modal"></button>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <!-- <h4 class="modal-title"> -->
                <center><img src="{{$tampilan->data()->logo_aplikasi}}" alt="{{$tampilan->data()->nama_aplikasi}}" class="img-responsive"></center>
            <!-- </h4> -->
          </div>
          <div class="modal-body">
            <h4 style="font-weight: bold;color: black; text-align: center;">SISTEM INFORMASI GEOGRAFIS <br /> WILAYAH KUMUH KOTA PONTIANAK</h4>
              <center><img src="/photos/1/p33.png" alt="{{$tampilan->data()->nama_aplikasi}}" class="img-responsive"></center>
 <!--           <div class="form-group">
                <label>KAB/KOTA</label>
                <select id="daerahs_id_modal" class="form-control">
                    <option value="semua">SEMUA DATA</option>
                    @foreach($daerah as $data)
                        <option value="{{ $data->id }}">{{ $data->nama_daerah }}</option>
                    @endforeach
                </select>
            </div>
            <small style="color: red;font-weight: bold;">*data demo gunakan kabupaten SAMBAS</small>
          </div> -->
          <div class="modal-footer">
            <button id="next-modal" type="button" class="btn btn-primary" data-dismiss="modal" style="width:100%;"><i class="fa fa-right-arrow"></i> SELANJUTNYA</button>
            
          </div>
        </div>

      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!--Google maps API linl-->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyD8iakYfGi4g2t_w07QQV0W5IdfUY2v4mc&libraries=drawing,geometry,places"></script>
    <!--Your map settings script-->

    <script type="text/javascript" src="/js/MeasureTool.js"></script>

    <script src="/geoxml3/kmz/geoxml3.js"></script>

    <script src="/geoxml3/kmz/ZipFile.complete.js"></script>

    <!-- <script type="text/javascript" src="/js/map.js"></script> -->
    <!--jQuery-->
        <script type="text/javascript" src="/js/jQueryv2.0.3.js"></script>
    <script type="text/javascript" src="/js/pxgradient-1.0.2.jquery.js"></script>

    <script src="/js/bootstrap.js"></script>

    <script src="/pace/pace.min.js"></script>


    <!-- Datatables -->
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js
    "></script>
    <script src="https://cdn.datatables.net/responsive/2.1.0/js/dataTables.responsive.min.js"></script>

    <script type="text/javascript" src="/js/rupiah.js"></script>

    <!--Script for worked left smile categoryes menu-->
    <script type="text/javascript">
        $(document).ready(function () {
                        "use strict";
                        $("#cont").stop(false, false).hide();
                        $("#vcard").stop(false, false).hide();
                        var otable = $('#tabel').DataTable( {
                            "lengthMenu": [[-1, 10, 25, 50], ["Semua", 10, 25, 50]],
                            responsive: true,
                            "language": {
                                "sProcessing":   "Sedang memproses...",
                                "sLengthMenu":   "Tampilkan _MENU_ entri",
                                "sZeroRecords":  "Tidak ditemukan data yang sesuai",
                                "sInfo":         "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                                "sInfoEmpty":    "Menampilkan 0 sampai 0 dari 0 entri",
                                "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                                "sInfoPostFix":  "",
                                "sSearch":       "Cari:",
                                "sUrl":          "",
                                "oPaginate": {
                                    "sFirst":    "Pertama",
                                    "sPrevious": "Sebelumnya",
                                    "sNext":     "Selanjutnya",
                                    "sLast":     "Terakhir"
                                }
                            },
                            "columnDefs": [
                                {
                                    "targets": [ 6 ],
                                    "visible": false,
                                    "searchable": false
                                }
                            ],
                            "footerCallback": function ( row, data, start, end, display ) {
                                    var api = this.api(), data;
                                    var hasil = 0;
                                    // Remove the formatting to get integer data for summation
                                    var intVal = function ( i ) {
                                        return typeof i === 'string' ?
                                            i.replace(/[\$,]/g, '')*1 :
                                            typeof i === 'number' ?
                                                i : 0;
                                    };

                                    // Total over all pages
                                    var total = api
                                        .column( 5 )
                                        .data()
                                        .reduce( function (a, b) {
                                            hasil = parseFloat( intVal(a) )+parseFloat( intVal(b) );
                                            hasil.toFixed(2);
                                            return hasil;
                                        }, 0 );

                                    // Total over this page
                                    var pageTotal = api
                                        .column( 5, { page: 'current'} )
                                        .data()
                                        .reduce( function (a, b) {
                                            hasil = parseFloat( intVal(a) )+parseFloat( intVal(b) );
                                            hasil.toFixed(2);
                                            return hasil;
                                        }, 0 );

                                    total = parseFloat(total).toFixed(2);
                                    pageTotal = parseFloat(pageTotal).toFixed(2);

                                    // Update footer
                                    $( api.column( 0 ).footer() ).html(
                                        'Total Keseluruhan Data ( '+ toRp(total) +' )'
                                    );
                                    $( api.column( 1 ).footer() ).html(
                                        'Total Pada Data Halaman ini : '+toRp(pageTotal)+' '
                                    );
                                }
                        } );

        $('#daerahs_id_modal').change(function(){
            // alert('work');
            // $('#daerah_id_tabel').val( $(this).val() );
            // $('#data-layer select[name=daerahs_id]').val($(this).val());
        });

        $('#daerah_id_tabel').on( 'change', function () {
            var keyword = $('#daerah_id_tabel option[value='+$(this).val()+']').text();
            if (keyword != 'SEMUA DATA') {
                otable.search( keyword ).draw();
            } else {
                otable.search( '' ).draw();
            }
        } );

        $('#btn_cari_tabel').on( 'click', function () {
            var keyword = $('#daerah_id_tabel option[value='+$('#daerah_id_tabel').val()+']').text();
            if (keyword != 'SEMUA DATA') {
                otable.search( keyword ).draw();
            } else {
                otable.search( '' ).draw();
            }
        } );

        // $('#next-modal').click(function(){
        //     loadlayer();
        //     BlitzMap.tengah(109.34877325710522,-0.03851127974675606,13);
        //     $( "#btn_cari_tabel" ).trigger( "click" );
        // });

            $(".inner ul li a").each(function (i) {
                $(".inner ul li a:eq(" + i + ")").click(function () {
                    var tab_id = i + 1;
                    if (tab_id==1) {
                        $(".inner ul li a").removeClass("active");
                        $("#tabs .active").removeClass("active");
                        $(this).addClass("active");
                        $("#cont").stop(false, false).hide();
                        $("#vcard").stop(false, false).hide();
                        return false;
                    } else if(tab_id==3){
                        $(".inner ul li a").removeClass("active");
                        $("#tabs .active").removeClass("active");
                        $(this).addClass("active");
                        $("#cont").stop(false, false).hide();
                        $("#vcard").stop(false, false).show();
                        return false;
                    } else {
                        $("#cont").stop(false, false).show();
                        $(".inner ul li a").removeClass("active");
                        $("#tabs .active").removeClass("active");
                        $(this).addClass("active");
                        $("#tabs div").stop(false, false).hide();
                        $("#vcard").stop(false, false).hide();
                        $("#tab" + tab_id).stop(false, false).show();
                        return false;
                    }
                })
            })
        })
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
                        "use strict";
            $("#tabs_point li a").each(function (i) {
                $("#tabs_point li a:eq(" + i + ")").click(function () {
                    var tab_id = i + 1;
                    $("#tabs_point li a").removeClass("active");
                    $(".tabs_block_point .active").removeClass("active");
                    $(this).addClass("active");
                    $(".tabs_block_point div").stop(false, false).hide();
                    $("#point_tab" + tab_id).stop(false, false).show();
                    return false;
                })
            })
        })
    </script>
    <!--/Script for worked left smile categoryes menu-->

    <!--Script for worked profile page-->
    <script type="text/javascript" src="js/owl.carousel.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
                        "use strict";
            $('#link_open').on('click', function () {
                if ($('#link_open').hasClass("clooses")) {
                    $("#open_span").removeClass("close_span").addClass("open_span");
                    $("#profile").removeClass("profile_closed");
                    $("#link_open").removeClass("clooses");
                    $("#cont").addClass("none");
                }
                else {
                    $("#open_span").addClass("close_span").removeClass("open_span");
                    $("#profile").addClass("profile_closed");
                    $("#link_open").addClass("clooses");
                    $("#cont").removeClass("none");
                }
            })
              $('#map_open').on('click', function () {
                            "use strict";
            $("#cont").addClass("none");
            $("#Show_cont").removeClass("none");

        })
        $('#Show_cont').on('click', function () {
                        "use strict";
            $("#cont").removeClass("none");
        })
        });
    </script>

    <script type="text/javascript">

        // $(function () {
        //     var we = document.getElementById('web').value;
        //     if (we === 'front') {
        //       // your code here
        //       $('#showup').modal('show');
        //     }
        //     // $('#showup').modal('show');
        // //                 "use strict";
        // //     $("#owl-demo, #myguest").owlCarousel({
        // //         items: 6,
        // //         itemsDesktop: [1000, 5],
        // //         itemsDesktopSmall: [900, 6],
        // //         itemsTablet: [600, 2],
        // //         itemsMobile: false
        // //     });

        // });

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
    <script type="text/javascript">
        var Layer = [];


        // function loadlayer() {

        //     // var url = '{{ Request::URL() }}';
        //     // if ( $(this).val() != 'all' ) {
        //     //     url += '?kecamatan='+$(this).val();
        //     // }
        //     // $(location).attr('href',url);
        // }

    </script>
    <!--/Script for worked profile page-->
     <!-- test -->
    <script type="text/javascript" src="/geoxml3/ProjectedOverlay.js"></script>
    <script src="/blitz/jscolor/jscolor.js" type="text/javascript"></script>
    <script src="/blitz/json2.js" type="text/javascript"></script>
    <script src="/blitz/xmlwriter.js" type="text/javascript"></script>
    <script src="/blitz/blitz.gmap3.js" type="text/javascript"></script>
    <script type="text/javascript"></script>
    <script type="text/javascript">
        var map = BlitzMap.setMap( 'myMap', false, 'mapData' );
        
        $('form').on('keyup keypress', function(e) {
          var keyCode = e.keyCode || e.which;
          if (keyCode === 13) { 
            e.preventDefault();
            return false;
          }
        });
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

        $('#save_data').click(function(){
           // alert('work');
           $('#generate_text').trigger('click');
           // alert($('#mapData').text());
        });



        function LihatPeta(id) {
            // console.log(id);
              $.ajax({
                  type:"GET",
                  url: "/api/cari-data/"+id,
                  dataType: 'json',
                  cache: false,
                  success: function(msg){
                        var center = msg['data'];
                        // alert(center);
                        var jsoncenter = JSON.parse( center );
                        // var aw = JSON.stringify(center);
                        var x = jsoncenter.center.lng;
                        // var xx = JSON.stringify(x);
                        // alert(x);
                        var y = jsoncenter.center.lat;
                        var besar = jsoncenter.zoom;
                        // var yy = JSON.stringify(y);
                      // console.log(x+' '+y);
                      // var point = new google.maps.LatLng(parseFloat(xx),parseFloat(yy));
                      // console.log(point);
                      // map.setCenter(point);
                      // map.setZoom(17);
                      // var map = BlitzMap.setMap( 'myMap', false, aw );
                      BlitzMap.tengah(x,y,besar);
                      // BlitzMap.SearchBox(x);
                  }
              });
        }

        $('#next-modal').click(function(){
            // loadlayer();
            // BlitzMap.tengah(109.34001852688061,-0.02495003307871443,13);
            // $( "#btn_cari_tabel" ).trigger( "click" );
        });

        $(function () {
            var we = document.getElementById('web').value;
            if (we === 'front') {
              // your code here
              $('#showup').modal('show');
              // setTimeout(function() {
              //       BlitzMap.tengah(109.34001852688061,-0.02495003307871443,13);
              //   }, 3000);
            } else {
                // setTimeout(function() {
                //     document.getElementById("zoom").click();
                // }, 3000);
            }
            // $('#next-modal').trigger('click');
            // BlitzMap.tengah(109.34001852688061,-0.02495003307871443,13);
            // $('#showup').modal('show');
        //                 "use strict";
        //     $("#owl-demo, #myguest").owlCarousel({
        //         items: 6,
        //         itemsDesktop: [1000, 5],
        //         itemsDesktopSmall: [900, 6],
        //         itemsTablet: [600, 2],
        //         itemsMobile: false
        //     });

        });

        $('#zoom').click(function(){
            // loadlayer();
            // BlitzMap.tengah(109.34001852688061,-0.02495003307871443,13);
            // $( "#btn_cari_tabel" ).trigger( "click" );
        });

        // $(document).ready(function () {
        //     setTimeout(function() {
        //         document.getElementById("zoom").click();
        //     }, 3000);
        // });
    </script>
</body>
</html>


