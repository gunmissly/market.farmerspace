@extends('layouts.master') @section('content')
<!--header start here-->
<link href="{{ URL::asset('market/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
<script src="{{ URL::asset('market/js/bootstrap-notify.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<style>
    .header-right p{
        font-size: 16px;font-weight: 300;text-align: right;
    }
    .copyrights p{
        display: none;
    }
</style>
<div class="header-main" style="padding: 3.1em 2em;">
    <div class="header-left" style="position: absolute;top: 0;left: 200px">
        <img src="{{ asset('market/images/market/header.png') }}" alt="" style="width: 50%">
        <div class="clearfix">
        </div>
    </div>
    <div class="header-right" style="position: absolute;top: 25px;right: 50px">
        <h2 style="margin-top: 0.3em;color: #186E0D;text-align: right;">
            ผลิตผลของคุณ
        </h2>
        <p style="padding-top:10px">กรุณากรอกข้อมูลผลผลิตโดยละเอียด</p>
        <p>และหมั่นตรวจสอบ แก้ไข  อย่างสม่ำเสมอ</p>
        <p>(ราคา วันที่ และปริมาณเก็บเกี่ยว)</p>
        <div class="clearfix">
        </div>
    </div>
    <div class="clearfix">
    </div>
</div>
<!--heder end here-->
<style>
    .gap{margin:20px;}
    .add-box{
        padding: 60px 40px ;
        border:2.5px dashed #9697B1;
        position: absolute;
        z-index: 1;
        background-color: #DDDDDD;
        cursor: pointer;
    }
    .add-box:hover{background-color: #D2D2D2;}
    .modal-content label{font-weight: 300;}
    .modal-content input{font-weight: 300;border-radius: 0px;}
    #map {
        height: 350px;
    }
    .panel{
        position: relative;
        padding: 0px;
        background-color: #fff;
        border-radius: 0px;
    }
    form label,input{
        font-weight: 300;
    }
    form .form-control{
        border-radius: 0px;
    }
    #pac-input{
        display: inline-block;padding: 6px 11px;margin: 10px;width: 400px;
    }
</style>

<!--inner block start here-->
<div class="inner-block" style="padding-top: 2em;">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
        <div class="contianer-fluid">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 chit-chat-layer1-left" style="">
                    <div class="panel panel-default">
                        <p class="text-center">
                            @include('flash::message')
                        </p>
                        @if(!empty($bodyGetProduct))
                        @foreach($bodyGetProduct as $bodyGetProduct)
                        <form id="updateForm" action="{{ url('product') }}/{{ $bodyGetProduct ['RequestID'] }}" method="POST" >
                            <div class="container-fluid">
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" style="margin-right: 40px">คุณคือ ?</label>
                                        <label class="radio-inline"><input type="radio" name="userradio" value="buyer"  {{ substr($bodyGetProduct ['RequestID'], 0, 1) === 'B' ? 'checked' : '' }}>ผู้สั่งซื้อ</label>
                                        <label class="radio-inline"><input type="radio" name="userradio" value="farmer" {{ substr($bodyGetProduct ['RequestID'], 0, 1) === 'S' ? 'checked' : '' }}>ผู้เสนอขาย</label>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">ชื่อผลผลิต</label>
                                        <input type="text" name="ProductName" class="form-control" value="{{ $bodyGetProduct ['ProductName'] }}" data-validation="required">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">สายพันธุ์</label>
                                        <input type="text" name="Species" class="form-control" value="{{ $bodyGetProduct ['Species']  }}" data-validation="required">
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">รายละเอียด <br>
                                            <small>** โปรดให้รายละเอียดเพิ่มเติม อาทิ รูปแบบผลผลิต จุดเด่น มาตรฐานที่ได้รับรอง เป็นต้น</small>
                                        </label>
                                        <textarea name="Detail" maxlength="300" rows="6" class="form-control" data-validation="required">{{ $bodyGetProduct ['Detail']  }}</textarea>
                                  </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">ราคา ต่อ กิโลกรัม</label>
                                        <input type="number" name="Price" class="form-control" value="{{ $bodyGetProduct ['Price']  }}" data-validation="number">
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">ปริมาณต่อการเก็บเกี่ยว (กิโลกรัม)</label>
                                        <input type="number" name="Quantity" class="form-control" value="{{ $bodyGetProduct ['Quantity']  }}" data-validation="number">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">วันเก็บเกี่ยว</label>
                                        <input type="date"  data-validation="date" data-validation-format="yyyy-mm-dd" name="HarvestDay" class="form-control" value="{{ Carbon\Carbon::parse($bodyGetProduct ['HarvestDay'])->format('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="">จุดรับ - ซื้อขาย ผลผลิต</label>
                                        <input id="pac-input" type=="ค้นหา...">
                                        <div id="map"></div>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="" style="margin-right: 40px">สถานที่เพาะปลูก</label>
                                         <label class="radio-inline"><input type="radio" name="addresradio" value="oldAddress" id="oldAddress" required checked>ใช้ที่อยู่เดียวกับประวัติ</label>
                                        <label class="radio-inline"><input type="radio" name="addresradio" value="newAddress" id="newAddress">ระบุที่อยู่ใหม่</label>
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <label for="">เลขที่</label>
                                            <input type="text" name="Address" class="newAddress form-control"  readonly="" value="{{ $bodyGetProduct ['Address']  }}">
                                        </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">ตำบล</label>
                                        <input type="text" name="SubDistrict" class="newAddress form-control" readonly="" value="{{ $bodyGetProduct ['SubDistrict']  }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">อำเภอ</label>
                                        <input type="text" name="District" class="newAddress form-control" readonly="" value="{{ $bodyGetProduct ['District']  }}">
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="">จังหวัด</label>
                                        <input type="text" name="Province" class="newAddress form-control" readonly="" value="{{ $bodyGetProduct ['Province']  }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">รหัสไปรษณีย์</label>
                                        <input type="text" name="Zipcode" class="newAddress form-control" readonly="" value="{{ $bodyGetProduct ['Zipcode']  }}">
                                    </div>
                                </div>
                                <div class="gap"></div>
                                <input type="hidden" id="lat" name="Latitude" value="{{ $bodyGetProduct ['Latitude'] }}">
                                <input type="hidden" id="lng" name="Longitude" value="{{ $bodyGetProduct ['Longitude'] }}">
                                <input type="hidden" name="RequestID" value="{{ $bodyGetProduct ['RequestID'] }}">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                                @if (session('key') == $bodyGetProduct['UserID'])
                                    <button class="btn btn-lg btn-danger pull-right" style="border-radius: 0px;color:#fff;margin-left: 5px;" type="button" id="delete" onclick="DeleteProduct('{{ $bodyGetProduct ['ProductName'] }}','{{ $bodyGetProduct ['RequestID'] }}')"><span>Delete</span>
                                    </button>
                                @endif
                                <button class="btn btn-lg pull-right" style="border-radius: 0px;background-color: #6495ed;color:#fff" type="submit" id="submit"><span>Update</span>
                                </button>
                            </div>
                        </form>
                        @endforeach
                        @endif
                    </div>
                </div>
                <div class="clearfix">
                </div>
            </div>
        </div>
    </div>
    <!--main page chit chating end here-->

    <script>
        $( document ).ready(function() {
        $('#market-text a').css('color', '#5093E1');
        $('#market-text').css('border-left', '4px solid #5093E1');
    });
    </script>
</div>
<!--inner block end here-->
<div class="copyrights">
       <img alt="Logo" class="img img-responsive" align="right" style="width: 150px;margin: 10px" src="{{ URL::asset('/images/LogoHeader.png') }}"/>
</div>
<script type="text/javascript">
    function DeleteProduct(title,id) {
        if (confirm('Do you want to delete : ' + title)) {
                var url = "https://www.farmerspace.co/api/deleteProduct.php?" + $.param({"id": id});
                fetch(url,{
                    mode: 'no-cors',
                    method: 'get',
                });
            window.location = '{{ url('/') }}';
        } else {
            // Do nothing!
        }
    }
</script>
<script>
    $.validate({
        lang: 'en'
    });
</script>
<script>
     $("#newAddress").click(function() {
        $('.newAddress').prop('readonly', false);
    });
    $("#oldAddress").click(function() {
        $('.newAddress').prop('readonly', true);
    });
    if ($("#newAddress").is(":checked")) {
        $('.newAddress').prop('readonly', false);
    }
    if ($("#oldAddress").is(":checked")) {
        $('.newAddress').prop('readonly', true);
    }
</script>

<script>
    // In the following example, markers appear when the user clicks on the map.
    // The markers are stored in an array.
    // The user can then click an option to hide, show or delete the markers.
    var map;
    var markers = [];
    var haightAshbury  = {lat: {{ $bodyGetProduct ['Latitude'] }}, lng: {{ $bodyGetProduct ['Longitude'] }} };

    function initAutocomplete() {

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: haightAshbury ,
            mapTypeId: 'roadmap'

        });

        // Adds a marker at the center of the map.
        addMarker(haightAshbury);

        infoWindow = new google.maps.InfoWindow;

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });

         // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
          });
          map.fitBounds(bounds);
        });

        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
            addMarker(event.latLng);
            document.getElementById('lat').value = event.latLng.lat();
            document.getElementById('lng').value = event.latLng.lng();
        });

    }

    // Adds a marker to the map and push to the array.
    function addMarker(location) {
        if (markers.length < 1) {
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        } else {
            deleteMarkers();
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
            markers.push(marker);
        }
    }

    // Sets the map on all markers in the array.
    function setMapOnAll(map) {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(map);
        }
    }

    // Deletes all markers in the array by removing references to them.
    function deleteMarkers() {
        document.getElementById('lat').value = '';
        document.getElementById('lng').value = '';
        setMapOnAll(null);
        markers = [];
    }



</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHdovUZxzjIxZEKeOECAj0T2bH_l5Iw_0&libraries=places&callback=initAutocomplete">
</script>

@endsection
