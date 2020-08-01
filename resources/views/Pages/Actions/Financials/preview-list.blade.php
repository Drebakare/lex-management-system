@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Supply Your Filtering Criteria</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Select Year, Month and Department to be Processed</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Session Information</h4>
                            <h6>Kindly supply correct information</h6>
                            <form method="get" action="{{route('user.print-salary-list')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Year</label>
                                            <select name="year" class="form-control select2"  required>
                                                @foreach($years as $year)
                                                    <option value="{{$year->id}}"  >{{$year->year}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Month</label>
                                            <select name="month" class="form-control select2"  required>
                                                @foreach($months as $month)
                                                    <option value="{{$month->id}}" >{{$month->month}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success mr-1 waves-effect waves-light">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
