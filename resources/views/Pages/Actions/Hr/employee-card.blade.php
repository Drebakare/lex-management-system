@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">ID Card</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">ID Card</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row" id="html-content-holder">
                <div class="col-xl-8 offset-1">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <img src="{{asset('uploads/card_header.png')}}" class="img-fluid">
                            </div>
                        </div>
                        <div class="card-body pt-0" style="background-image: url('{{asset('uploads/card_background.png')}}')">
                            <div class="row pl-3">
                                <div class="col-sm-4">
                                    <div class="avatar-xl profile-user-wid">
                                        <img src="{{$employee->images ? asset('uploads/'.$employee->images[0]->image_name) : asset('uploads/man.png')}}" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="pt-4">
                                        <div>
                                            <div class="col-12" style="margin-left: -70px">
                                                <h4 class="font-size-24" style="color: navy; font-weight: bolder" >{{strtoupper($employee->surname) ." ". $employee->first_name ." ". $employee->other_name}}</h4>
                                                <h4 class="font-size-20 mb-0" style="color: red; font-weight: bold">{{$employee->employeeWorkDetail->designation->designation}}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-1">
                                   <h5 style="writing-mode: vertical-rl; text-orientation: sideways; margin-left: -1px; margin-top: -52px; font-size: 17px; font-weight: bold; color:red">
                                       {{$employee->employeeWorkDetail->department->department}}
                                   </h5>
                                </div>
                                <div class="col-sm-11">
                                    <div class="mt-4 ml-3">
                                        <div class="row" style="margin-bottom: -20px">
                                            <div class="col-3 row" style="margin-left: -50px;">
                                                <div class="col-md-8">
                                                    <h6 style="color: navy; font-size: 12px"> Staff ID:</h6>
                                                    <h6 style="color: #a2a2a2; font-size: 10px !important; margin-top: -5px">{{$employee->staff_id}}</h6>
                                                    <h6 style="color: navy; font-size: 12px"> Date of Issue:</h6>
                                                    <h6 style="color: #a2a2a2; font-size: 10px !important; margin-top: -5px; margin-bottom: -10px">{{date("Y/m/d")}}</h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="vl"></div>
                                                </div>
                                            </div>
                                            <div class="col-3 row">
                                                <div class="col-md-8">
                                                    <h6 style="color: navy; font-size: 12px"> Gender:</h6>
                                                    <h6 style="color: #a2a2a2; font-size: 10px !important; margin-top: -5px">{{$employee->title_id == 2? "Male" : "Female"}}</h6>
                                                    <h6 style="color: navy; font-size: 12px"> Valid For:</h6>
                                                    <h6 style="color: #a2a2a2; font-size: 10px !important; margin-top: -5px; margin-bottom: -10px"> 2020 - 2021</h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="vl"></div>
                                                </div>
                                            </div>
                                            <div class="col-4 row">
                                                <div class="col-md-10" style="margin-top: 8px;">
                                                    <h6 style="color: #a2a2a2; font-size: 12px !important;"> +2348037173026</h6>
                                                    <h6 style="color: #a2a2a2; font-size: 12px"> Tech@lexican.com.ng</h6>
                                                    <h6 style="color: navy; font-size: 12px"> www.lexican.com.ng</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="vl"></div>
                                                </div>
                                            </div>
                                            <div class="col-2" id="qrcode" style="margin-top: -60px; margin-right: 85px">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="d-print-none">
                <div class="float-right">
                    <a href="#" class="btn btn-success waves-effect waves-light mr-1" id="btn-Convert-Html2Image">
                        <i class="fa fa-print"></i></a>
                    <a href="#" class="btn btn-success waves-effect waves-light mr-1" id="btn-Preview-Image">
                        <i class="fa fa-print"></i></a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_contents')
    <script>
        $(window).on('load', function () {
            let token = '{{route('api.fetch-employee-details', ['token' => $employee->api_token])}}';
            $('#qrcode').css({
                'width' : 128,
                'height' : 128
            })
            $('#qrcode').qrcode({width: 128,height: 128,text: token});
        })
        $(document).ready(function() {

            // Global variable
            var element = $("#html-content-holder");

            // Global variable
            var getCanvas;
            $("#btn-Preview-Image").on('click', function() {
                html2canvas(element, {
                    onrendered: function(canvas) {
                        $("#previewImage").append(canvas);
                        getCanvas = canvas;
                    }
                });
            });

            $("#btn-Convert-Html2Image").on('click', function() {
                var imgageData =
                    getCanvas.toDataURL("image/png");

                // Now browser starts downloading
                // it instead of just showing it
                var newData = imgageData.replace(
                    /^data:image\/png/, "data:application/octet-stream");

                $("#btn-Convert-Html2Image").attr(
                    "download", "idcard.png").attr(
                    "href", newData);
            });
        });
    </script>
@endsection
