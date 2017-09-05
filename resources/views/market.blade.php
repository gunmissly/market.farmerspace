@extends('layouts.master') @section('content')
<style>
    .card {
        cursor: pointer;
        font-weight: 300;
        width: 210px;
        height: auto;
        position: relative;
        background: #fff;
        overflow: visible;
        margin: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
        display: inline-block;
    }

    .card:hover {
        background-color: #DDDDDD;
    }

    .card-header {
        padding: 20px 20px 0 20px;
    }
    .card-header h3{
      font-size: 26px;
      font-weight: 600;
      padding-bottom: 0px;
    }
    .card-body{
      padding: 0 10px 0 10px
    }
    .card-footer {
        padding: 0px
    }
    .card-detail {
        padding: 10px;
        word-wrap: break-word;
        height: 7ex;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        max-height: 55px;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }

    .card-detail h5 {
      font-weight: 300;
        font-size: 10px;
        color: #333;
        line-height: 15px;
    }

    .card-price {
        padding: 10px;
    }

    .card-price h3 {
      color: #03AF25;
      font-weight: 600;
      letter-spacing: 2px;
    }

    .card-price p {
        color: #03AF25;
        font-size: 9px;
        font-weight: bold;
    }

    .card-harvest {
        width: 100%;
        height: 64px;
        background: #eee;
        overflow: hidden;
        text-transform: uppercase;
        display: table;
    }

    .card-harvest p {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        line-height: 20px;
        font-size: 9px;
        font-weight: 500;
        color: #fff;
    }

    .card-harvest span {
        font-size: 24px;
        font-weight: 300;
    }

</style>
<style>
    .header-right p{
        font-size: 15px;letter-spacing:5px;font-weight: 300;text-align: right;line-height:1.5em;color:#9DA0A7;
    }
    .copyrights{
        position: absolute;bottom: 0px;right: 0px;
    }
    .copyrights p{
        display: none;
    }
    .add-box{
        border:2.7px dashed #9DA5BE;
        cursor: pointer;
        background-color: #DDDDDD
    }
    .add-box:hover{background-color: #D2D2D2;}
</style>
<style>
    .ribbon-wrapper-1 {
      width: 106px;
      height: 108px;
      overflow: hidden;
      position: absolute;
      top: -6px;
      right: -6px; }

    .ribbon-1 {
      font: bold 15px Sans-Serif;
      line-height: 18px;
      color: #333;
      text-align: center;
      text-transform: uppercase;
      -webkit-transform: rotate(45deg);
      -moz-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      -o-transform: rotate(45deg);
      position: relative;
      padding: 7px 0;
      left: 15px;
      top:15px;
      width: 120px;
      background-color: #03AF25;
      color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      letter-spacing: 0.5px; }

    .ribbon-1:before, .ribbon-1:after {
      content: "";
      border-top: 4px solid #4e7c7d;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      position: absolute;
      bottom: -4px; }

    .ribbon-1:before {
      left: 0; }

    .ribbon-1:after {
      right: 0; }

    .ribbon-wrapper-2 {
      width: 106px;
      height: 108px;
      overflow: hidden;
      position: absolute;
      top: -6px;
      right: -6px; }

    .ribbon-2 {
      font: bold 15px Sans-Serif;
      line-height: 18px;
      color: #333;
      text-align: center;
      text-transform: uppercase;
      -webkit-transform: rotate(45deg);
      -moz-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      -o-transform: rotate(45deg);
      position: relative;
      padding: 7px 0;
      left: 15px;
      top: 15px;
      width: 120px;
      background-color: #5093E1;
      color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      letter-spacing: 0.5px; }

    .ribbon-2:before, .ribbon-2:after {
      content: "";
      border-top: 4px solid #4e7c7d;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
      position: absolute;
      bottom: -4px; }

    .ribbon-2:before {
      left: 0; }

    .ribbon-2:after {
      right: 0; }
</style>

<!--header start here-->
<div style="padding: 3.1em 2em;background-color: #FFF">
    <div class="header-left" style="position: absolute;top: 0;left: 10%;">
        <img src="{{ asset('market/images/market/header.png') }}" alt="" style="width:60%">
    </div>

    <div class="header-right" style="position: absolute;right: 50px;width:40%;">
        <h2 style="margin-top: 0.3em;color: #186E0D;text-align: right;font-size:3em">
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

<!--inner block start here-->
<div class="inner-block" style="padding-top: 5em;background-color: transparent;z-index: 1;background-color: #FFF">
    <!--mainpage chit-chating-->
    <div class="chit-chat-layer1">
    <div class="container">
                     <div class="row">
                <!-- Buyer -->
                @if(!empty($buyer_jsonDecodeGetProduct))
                   @foreach($buyer_jsonDecodeGetProduct as $buyer_dataProduct)
                    <div class='card' onclick="window.location ='{{ url('/product') }}/{{ $buyer_dataProduct['RequestID'] }}/edit';">
                        <div class="col-md-12 card-header">
                            <h3>{{ $buyer_dataProduct ['ProductName'] }}</h3>
                            <small>{{ $buyer_dataProduct ['Species'] }}</small>
                        </div>
                        <div class="col-md-12 card-body">
                          <div class="col-md-12 card-detail">
                              <h5>{{ $buyer_dataProduct ['Detail'] }}</h5>
                          </div>
                          <div class="col-xs-6 col-md-6 card-price" style="">
                              <p>Bath</p>
                              <h3>{{ $buyer_dataProduct ['Price'] }}</h3>
                              <p style="color: inherit;">ราคา : กิโลกรัม</p>
                          </div>
                          <div class="col-xs-6 col-md-6 card-price">
                              <p>kg.</p>
                              <h3>{{ $buyer_dataProduct ['Quantity'] }}</h3>
                              <p style="color: inherit;">ปริมาณก็บเกี่ยว</p>
                          </div>
                        </div>
                        <div class="col-md-12 card-footer">
                            <div class='card-harvest' style="background-color: #03AF25">
                            <p>วันที่เก็บเกี่ยว<br>
                            <span>{{ Carbon\Carbon::parse($buyer_dataProduct ['HarvestDay'])->format('d/m/Y') }}</span>
                            </p>
                        </div>
                        </div>
                        <div class='ribbon-wrapper-1'>
                            <div class='ribbon-1'>Buyer</div>
                        </div>
                   </div>
                    @endforeach
                    <div class="card add-box" style="box-shadow:none;" onclick="window.location ='{{ url('/create') }}';">
                        <div class="col-md-12 card-footer">
                            <div style=" width: 100%;height: 64px;display: table;"></div>
                        </div>
                        <div class="col-md-12 card-body text-center">
                            <img src="{{ url('market/images/149156.svg') }}" alt="" style="width: 50px;margin:20px">
                            <h3 style="color:#9DA5BE;font-weight: 300">เพิ่มผลผลิต</h3>
                            <div class="col-md-12 card-detail">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price" style="">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card add-box" style="box-shadow:none;" onclick="window.location ='{{ url('/create') }}';">
                        <div class="col-md-12 card-header">
                        </div>
                        <div class="col-md-12 card-footer">
                            <div style=" width: 100%;height: 64px;display: table;"></div>
                        </div>
                        <div class="col-md-12 card-body text-center">
                            <p style="font-size: 40px;color:#9DA5BE">
                                <i aria-hidden="true" class="fa fa-plus fa-2x"></i>
                            </p>
                            <h3 style="color:#9DA5BE;font-weight: 300">เพิ่มผลผลิต</h3>
                            <div class="col-md-12 card-detail">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price" style="">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price">
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Farmer -->
                @if(!empty($farmer_jsonDecodeGetProduct))
                   @foreach($farmer_jsonDecodeGetProduct as $farmer_dataProduct)
                     <div class='card' onclick="window.location ='{{ url('/product') }}/{{ $farmer_dataProduct['RequestID'] }}/edit';">
                        <div class="col-md-12 card-header">
                            <h3>{{ $farmer_dataProduct ['ProductName'] }}</h3>
                            <small>{{ $farmer_dataProduct ['Species'] }}</small>
                        </div>
                        <div class="col-md-12 card-body">
                          <div class="col-md-12 card-detail">
                              <h5>{{ $farmer_dataProduct ['Detail'] }}</h5>
                          </div>
                          <div class="col-xs-6 col-md-6 card-price" style="">
                              <p>Bath</p>
                              <h3>{{ $farmer_dataProduct ['Price'] }}</h3>
                              <p style="color: inherit;">ราคา : กิโลกรัม</p>
                          </div>
                          <div class="col-xs-6 col-md-6 card-price">
                              <p>kg.</p>
                              <h3>{{ $farmer_dataProduct ['Quantity'] }}</h3>
                              <p style="color: inherit;">ปริมาณเก็บเกี่ยว</p>
                          </div>
                        </div>
                        <div class="col-md-12 card-footer">
                            <div class='card-harvest' style="background-color: #5093E1">
                            <p>วันที่เก็บเกี่ยว<br>
                            <span>{{ Carbon\Carbon::parse($farmer_dataProduct ['HarvestDay'])->format('d/m/Y') }}</span>
                            </p>
                        </div>
                        </div>
                        <div class='ribbon-wrapper-2'>
                            <div class='ribbon-2'>Farmer</div>
                        </div>
                   </div>
                    @endforeach
                    <div class="card add-box" style="box-shadow:none;" onclick="window.location ='{{ url('/create') }}';">
                        <div class="col-md-12 card-footer">
                            <div style=" width: 100%;height: 64px;display: table;"></div>
                        </div>
                        <div class="col-md-12 card-body text-center">
                            <img src="{{ url('market/images/149156.svg') }}" alt="" style="width: 50px;margin:20px">
                            <h3 style="color:#9DA5BE;font-weight: 300">เพิ่มผลผลิต</h3>
                            <div class="col-md-12 card-detail">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price" style="">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price">
                            </div>
                        </div>
                    </div>
                @else
                    <div class="card add-box" style="box-shadow:none;" onclick="window.location ='{{ url('/create') }}';">
                        <div class="col-md-12 card-header">
                        </div>
                        <div class="col-md-12 card-footer">
                            <div style=" width: 100%;height: 64px;display: table;"></div>
                        </div>
                        <div class="col-md-12 card-body text-center">
                            <p style="font-size: 40px;color:#9DA5BE">
                                <i aria-hidden="true" class="fa fa-plus fa-2x"></i>
                            </p>
                            <h3 style="color:#9DA5BE;font-weight: 300">เพิ่มผลผลิต</h3>
                            <div class="col-md-12 card-detail">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price" style="">
                            </div>
                            <div class="col-xs-6 col-md-6 card-price">
                            </div>
                        </div>
                    </div>
                @endif
  </div>
                     </div>
        <div class="clearfix">
        </div>
    </div>
    <!--main page chit chating end here-->

    <script>
        $( document ).ready(function() {
        $('#market-text a').css('color', '#5093E1');
        $('#market-text').css('border-left', '4px solid #5093E1');
    });
    </script>
    <div class="copyrights">
        <img alt="Logo" class="img img-responsive" align="right" style="width: 150px;margin: 10px" src="{{ URL::asset('/images/LogoHeader.png') }}"/>
    </div>
</div>
<!--inner block end here-->


@endsection
