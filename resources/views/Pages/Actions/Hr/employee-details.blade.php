@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18"> Add\Edit Employee</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Employee Details</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Employee Details</h4>
                            <div id="basic-pills-wizard" class="twitter-bs-wizard">
                                <ul class="twitter-bs-wizard-nav">
                                    <li class="nav-item">
                                        <a href="#seller-details" class="nav-link" data-toggle="tab">
                                            <span class="step-number mr-2">01</span>
                                            Personal Info
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#company-document" class="nav-link" data-toggle="tab">
                                            <span class="step-number mr-2">02</span>
                                            <span>Education Details</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#bank-detail" class="nav-link" data-toggle="tab">
                                            <span class="step-number mr-2">03</span>
                                            Work Details
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#confirm-detail" class="nav-link" data-toggle="tab">
                                            <span class="step-number mr-2">04</span>
                                            Add Job History
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="#guarantor" class="nav-link" data-toggle="tab">
                                            <span class="step-number mr-2">05</span>
                                            Add Guarantor
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content twitter-bs-wizard-tab-content">
                                    <div class="tab-pane" id="seller-details">
                                        <form action="{{route('user.update-employee-data', ['token' => $employee->token])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Title</label>
                                                        <select name="title" class="custom-select">
                                                            @foreach($titles as $title)
                                                                <option value="{{$title->id}}" @if($title->id == $employee->title_id) selected @endif>{{$title->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Marital Status</label>
                                                        <select name="marital_status" class="custom-select">
                                                            @foreach($maritals as $marital)
                                                                <option value="{{$marital->id}}" @if($marital->id == $employee->marital_status_id) selected @endif>{{$marital->status}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <select name="state" class="custom-select">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}" @if($state->id == $employee->state_id) selected @endif>{{$state->state}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Home Town</label>
                                                        <select name="home_town" class="custom-select">
                                                            @foreach($homes as $home)
                                                                <option value="{{$home->id}}" @if($home->id == $employee->home_town_id) selected @endif>{{$home->home_town}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Local Govt.</label>
                                                        <select name="lg" class="custom-select">
                                                            @foreach($lgs as $lg)
                                                                <option value="{{$lg->id}}" @if($lg->id == $employee->lg_id) selected @endif>{{$lg->lg}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-firstname-input">First name</label>
                                                        <input name="first_name" type="text" value="{{$employee->first_name}}" class="form-control" id="basicpill-firstname-input" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-lastname-input">Surname</label>
                                                        <input name="surname" value="{{$employee->surname}}" type="text" class="form-control" id="basicpill-lastname-input" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-phoneno-input">Other Name</label>
                                                        <input name="other_name" value="{{$employee->other_name}}" type="text" class="form-control" id="basicpill-phoneno-input">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                        <input name="phone_number" value="{{$employee->phone_number}}" type="tel" class="form-control" id="basicpill-phoneno-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-email-input">DOB</label>
                                                        <input name="dob" value="{{$employee->dob}}" type="date" class="form-control" id="basicpill-email-input" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label for="basicpill-address-input">Address</label>
                                                        <textarea name="address" id="basicpill-address-input" class="form-control" rows="2"> {{$employee->address}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="custom-file-container"
                                                         data-upload-id="upload-passport">
                                                        <label for="payment_proof_sell" class="text-sm"
                                                               style="font-family: OpenSans, sans-serif; color: #373e45; font-size: 18px; margin-top: 20px"
                                                        >
                                                            Upload Passport
                                                            <a
                                                                href="javascript:void(0)"
                                                                class="custom-file-container__image-clear"
                                                                id="close_image_preview-bitcoin-sell"
                                                                title="Clear Image"
                                                                style="color: red"
                                                            >
                                                                x
                                                            </a>
                                                        </label>
                                                        <label
                                                            class="custom-file-container__custom-file"
                                                            style="margin-bottom: 15px;"
                                                        >
                                                            <input type="file" name="passport"
                                                                   class="custom-file-container__custom-file__custom-file-input"
                                                                   id="payment_proof-bitcoin-sell" accept="image/jpeg">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                                            <span
                                                                class="custom-file-container__custom-file__custom-file-control"
                                                                style="font-family: Quicksand, sans-serif;"></span>
                                                        </label>
                                                        <div
                                                            class="custom-file-container__image-preview"
                                                            id="image-preview-placeholder-bitcoin-sell"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="custom-file-container"
                                                         data-upload-id="upload-user-picture">
                                                        <label for="payment_proof_sell" class="text-sm"
                                                               style="font-family: OpenSans, sans-serif; color: #373e45; font-size: 18px; margin-top: 20px"
                                                        >
                                                            Upload Full Picture
                                                            <a
                                                                href="javascript:void(0)"
                                                                class="custom-file-container__image-clear"
                                                                id="close_image_preview-bitcoin-sell"
                                                                title="Clear Image"
                                                                style="color: red"
                                                            >
                                                                x
                                                            </a>
                                                        </label>
                                                        <label
                                                            class="custom-file-container__custom-file"
                                                            style="margin-bottom: 15px;"
                                                        >
                                                            <input type="file" name="picture"
                                                                   class="custom-file-container__custom-file__custom-file-input"
                                                                   id="payment_proof-bitcoin-sell" accept="image/jpeg"
                                                                  >
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                                            <span
                                                                class="custom-file-container__custom-file__custom-file-control"
                                                                style="font-family: Quicksand, sans-serif;"></span>
                                                        </label>
                                                        <div
                                                            class="custom-file-container__image-preview"
                                                            id="image-preview-placeholder-bitcoin-sell"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="background-color: blue!important;">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light"> <<< Update Employee Details >>> </button>
                                            </div>
                                        </form>
                                        {{--<ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="#">Previous</a></li>
                                            <li class="next"><a href="#">Next</a></li>
                                        </ul>--}}
                                    </div>
                                    <div class="tab-pane" id="company-document">
                                        <div>
                                            <form method="post" action="{{route('user.add-employee-education', ['token' => $employee->token])}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-pancard-input">Qualification</label>
                                                            <select name="qualification" class="custom-select">
                                                                @foreach($qualifications as $qualification)
                                                                    <option value="{{$qualification->id}}">{{$qualification->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-vatno-input">State</label>
                                                            <select name="state" class="custom-select">
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}">{{$state->state}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-vatno-input">Home Town</label>
                                                            <select name="home_town" class="custom-select">
                                                                @foreach($homes as $home)
                                                                    <option value="{{$home->id}}">{{$home->home_town}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-cstno-input">School</label>
                                                            <input name="school"  type="text" class="form-control" id="basicpill-cstno-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-servicetax-input">Course</label>
                                                            <input name="course" value="" type="text" class="form-control" id="basicpill-servicetax-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-companyuin-input">Start Date</label>
                                                            <input name="start_date" value="" type="date" class="form-control" id="basicpill-companyuin-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-declaration-input">End Date</label>
                                                            <input name="end_date" value="" type="date" class="form-control" id="basicpill-Declaration-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="background-color: blue!important;">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light"> <<< Add Employee Education >>> </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="bank-detail">
                                        <div>
                                            <form method="post" action="{{route('user.add-employee-work-details', ['token' => $employee->token])}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Store</label>
                                                            <select name="store" class="custom-select" required>
                                                                @foreach($stores as $store)
                                                                    <option value="{{$store->id}}" @if($employee->employeeWorkDetail) @if($store->id == $employee->employeeWorkDetail->store_id) selected @endif @endif>{{$store->store}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Department</label>
                                                            <select name="department" class="custom-select" required>
                                                                @foreach($departments as $department)
                                                                    <option value="{{$department->id}}" @if($employee->employeeWorkDetail) @if($department->id == $employee->employeeWorkDetail->department_id) selected @endif @endif>{{$department->department}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label>Designation</label>
                                                            <select name="designation" class="custom-select" required>
                                                                @foreach($designations as $designation)
                                                                    <option value="{{$designation->id}}" @if($employee->employeeWorkDetail) @if($designation->id == $employee->employeeWorkDetail->designation_id) selected @endif @endif>{{$designation->designation}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-firstname-input">Start Date</label>
                                                            <input name="start_date"  type="date" value="{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->start_date : ""}}" class="form-control" id="basicpill-firstname-input" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-firstname-input">End Date</label>
                                                            <input name="end_date" type="date" value="{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->end_date : ""}}" class="form-control" id="basicpill-firstname-input">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="background-color: blue!important;">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light"> <<< Add Employee Education >>> </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="confirm-detail">
                                        <div>
                                            <form method="post" action="{{route('user.add-employee-employment-history', ['token' => $employee->token])}}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-vatno-input">State</label>
                                                            <select name="state" class="custom-select">
                                                                @foreach($states as $state)
                                                                    <option value="{{$state->id}}">{{$state->state}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-vatno-input">Home Town</label>
                                                            <select name="home_town" class="custom-select">
                                                                @foreach($homes as $home)
                                                                    <option value="{{$home->id}}" >{{$home->home_town}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-cstno-input">Job Title</label>
                                                            <input name="job" type="text" class="form-control" id="basicpill-cstno-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-cstno-input">Work Place</label>
                                                            <input name="place" type="text" class="form-control" id="basicpill-cstno-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-cstno-input">Salary Collected</label>
                                                            <input name="salary" type="number" min="500" class="form-control" id="basicpill-cstno-input">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-companyuin-input">Start Date</label>
                                                            <input name="start_date" type="date" class="form-control" id="basicpill-companyuin-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-declaration-input">End Date</label>
                                                            <input name="end_date"  type="date" class="form-control" id="basicpill-Declaration-input">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-address-input">Responsibility Description</label>
                                                            <textarea name="responsibility" id="basicpill-address-input" class="form-control" rows="2"> </textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="basicpill-address-input">Reason For Leave</label>
                                                            <textarea name="reason" id="basicpill-address-input" class="form-control" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="background-color: blue!important;">
                                                <div class="mt-4">
                                                    <button type="submit" class="btn btn-outline-primary waves-effect waves-light"> <<< Add Employee Employment History >>> </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="guarantor">
                                        <form action="{{route('user.update-employee-guarantor', ['token' => $employee->token])}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <select name="state" class="custom-select">
                                                            @foreach($states as $state)
                                                                <option value="{{$state->id}}">{{$state->state}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Home Town</label>
                                                        <select name="home_town" class="custom-select">
                                                            @foreach($homes as $home)
                                                                <option value="{{$home->id}}">{{$home->home_town}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Local Govt.</label>
                                                        <select name="lg" class="custom-select">
                                                            @foreach($lgs as $lg)
                                                                <option value="{{$lg->id}}">{{$lg->lg}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Relationship</label>
                                                        <select name="relationship" class="custom-select">
                                                            @foreach($relationships as $relationship)
                                                                <option value="{{$relationship->id}}" >{{$relationship->relationship}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-firstname-input">Full name</label>
                                                        <input name="name" type="text" class="form-control" id="basicpill-firstname-input" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-lastname-input">Occupation</label>
                                                        <input name="occupation"  type="text" class="form-control" id="basicpill-lastname-input" >
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-phoneno-input">Phone</label>
                                                        <input name="phone_number" type="tel" class="form-control" id="basicpill-phoneno-input">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="basicpill-address-input">Address</label>
                                                        <textarea name="address" id="basicpill-address-input" class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="custom-file-container"
                                                         data-upload-id="upload-signature">
                                                        <label for="payment_proof_sell" class="text-sm"
                                                               style="font-family: OpenSans, sans-serif; color: #373e45; font-size: 18px; margin-top: 20px"
                                                        >
                                                            Upload Guarantor's Signature
                                                            <a
                                                                href="javascript:void(0)"
                                                                class="custom-file-container__image-clear"
                                                                id="close_image_preview-bitcoin-sell"
                                                                title="Clear Image"
                                                                style="color: red"
                                                            >
                                                                x
                                                            </a>
                                                        </label>
                                                        <label
                                                            class="custom-file-container__custom-file"
                                                            style="margin-bottom: 15px;"
                                                        >
                                                            <input type="file" name="signature"
                                                                   class="custom-file-container__custom-file__custom-file-input"
                                                                   id="payment_proof-bitcoin-sell" accept="image/jpeg">
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                                            <span
                                                                class="custom-file-container__custom-file__custom-file-control"
                                                                style="font-family: Quicksand, sans-serif;"></span>
                                                        </label>
                                                        <div
                                                            class="custom-file-container__image-preview"
                                                            id="image-preview-placeholder-bitcoin-sell"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="custom-file-container"
                                                         data-upload-id="upload-guarantor">
                                                        <label for="payment_proof_sell" class="text-sm"
                                                               style="font-family: OpenSans, sans-serif; color: #373e45; font-size: 18px; margin-top: 20px"
                                                        >
                                                            Upload Guarantor's Passport
                                                            <a
                                                                href="javascript:void(0)"
                                                                class="custom-file-container__image-clear"
                                                                id="close_image_preview-bitcoin-sell"
                                                                title="Clear Image"
                                                                style="color: red"
                                                            >
                                                                x
                                                            </a>
                                                        </label>
                                                        <label
                                                            class="custom-file-container__custom-file"
                                                            style="margin-bottom: 15px;"
                                                        >
                                                            <input type="file" name="passport"
                                                                   class="custom-file-container__custom-file__custom-file-input"
                                                                   id="payment_proof-bitcoin-sell" accept="image/jpeg"
                                                            >
                                                            <input type="hidden" name="MAX_FILE_SIZE" value="10485760"/>
                                                            <span
                                                                class="custom-file-container__custom-file__custom-file-control"
                                                                style="font-family: Quicksand, sans-serif;"></span>
                                                        </label>
                                                        <div
                                                            class="custom-file-container__image-preview"
                                                            id="image-preview-placeholder-bitcoin-sell"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr style="background-color: blue!important;">
                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-outline-primary waves-effect waves-light"> <<< Add Employee Gaurantor's Details >>> </button>
                                            </div>
                                        </form>
                                        {{--<ul class="pager wizard twitter-bs-wizard-pager-link">
                                            <li class="previous"><a href="#">Previous</a></li>
                                            <li class="next"><a href="#">Next</a></li>
                                        </ul>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_contents')
    <script>
        var firstUpload = new FileUploadWithPreview('upload-passport')
        var firstUpload = new FileUploadWithPreview('upload-signature')
        var firstUpload = new FileUploadWithPreview('upload-guarantor')
        var secondUpload = new FileUploadWithPreview('upload-user-picture')
    </script>
@endsection
