@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Profile</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4">
                    <div class="card overflow-hidden">
                        <div class="bg-soft-primary">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-3">
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p>View {{$employee->surname}} Profile</p>
                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{asset('_admin/assets/images/profile-img.png')}}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <img src="{{$employee->images ? asset('uploads/'.$employee->images[0]->image_name) : asset('uploads/man.png')}}" alt="" class="img-thumbnail rounded-circle">
                                    </div>
                                    <h5 class="font-size-15 text-truncate">{{$employee->surname . $employee->first_name }}</h5>
                                    <p class="text-muted mb-0 text-truncate">{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->designation->designation : "nill"}}</p>
                                </div>

                                <div class="col-sm-8">
                                    <div class="pt-4">
                                        <div class="row">
                                            <div class="col-3">
                                                <h5 class="font-size-10">{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->query_count : 0 }}</h5>
                                                <h5 class="font-size-10 text-muted mb-0">Query</h5>
                                            </div>
                                            <div class="col-5">
                                                <h5 class="font-size-10">{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->start_date : "nill" }}</h5>
                                                <h5 class="font-size-10 text-muted mb-0">Start Date</h5>
                                            </div>
                                            <div class="col-4">
                                                <h5 class="font-size-10">
                                                    @if($employee->employeeWorkDetail)
                                                        @if($employee->employeeWorkDetail->end_date == null)
                                                            Nill
                                                        @else
                                                            {{$employee->employeeWorkDetail->end_date}}
                                                        @endif
                                                    @else
                                                        Nill
                                                    @endif
                                                    {{--{{$employee->employeeWorkDetail ? $employee->employeeWorkDetail->end_date : "nill" }}--}}</h5>
                                                <h5 class="font-size-10 text-muted mb-0">End Date</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Personal Information</h4>

                            <p class="text-muted mb-4">Hi, I'm {{$employee->first_name}} Below is my profile</p>
                            <div class="table-responsive">
                                <table class="table table-nowrap mb-0">
                                    <tbody>
                                    <tr>
                                        <th scope="row">Full Name :</th>
                                        <td>{{$employee->surname ." " . $employee->first_name }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Other Name :</th>
                                        <td>{{$employee->other_name ? $employee->other_name : "nill" }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Mobile :</th>
                                        <td>{{$employee->phone_number ? $employee->phone_number : "nill"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">DOB :</th>
                                        <td>{{$employee->dob}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">State :</th>
                                        <td>{{$employee->state ?  $employee->state->state : "nill"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Home Town :</th>
                                        <td>{{$employee->homeTown ?  $employee->homeTown->home_town : "nill"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Lg :</th>
                                        <td>{{$employee->lg ?  $employee->lg->lg : "nill"}}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row"> Address :</th>
                                        <td>{{$employee->address ? $employee->address : "nill"}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-5">Work History</h4>
                            @if($employee->employeeWorkHistory)
                                <div class="">
                                    <ul class="verti-timeline list-unstyled">
                                        @foreach($employee->employeeWorkHistory as $history)
                                            <li class="event-list active">
                                                <div class="event-timeline-dot">
                                                    <i class="bx bx-right-arrow-circle bx-fade-right"></i>
                                                </div>
                                                <div class="media">
                                                    <div class="mr-3">
                                                        <i class="bx bx-server h4 text-primary"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <div>
                                                            <h5 class="font-size-15"><a href="#" class="text-dark">{{$history->work_place}}</a></h5>
                                                            <span>Job Title : {{$history->job_title}}</span><br>
                                                            <span>From : {{$history->start_date}}  To : {{ $history->end_date}}</span><br>
                                                            <span>State : {{ $history->state->state}}</span><br>
                                                            <span>Home Town : {{ $history->homeTown->home_town}}</span><br>
                                                            <span>Salary : {{ $history->salary_collected}}</span><br>
                                                            <span>responsibility : {{ $history->responsibility_description}}</span><br>

                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @else
                                <h5 class="card-title mb-5">No Work History</h5>
                            @endif

                        </div>
                    </div>
                    <!-- end card -->
                </div>

                <div class="col-xl-8">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Employee Work Details</h4>
                                    @if($employee->employeeWorkDetail)
                                        <div class="table-responsive">
                                            <table class="table table-nowrap mb-0">
                                                <tbody>
                                                <tr>
                                                    <th scope="row"> Status:</th>
                                                    <td>{{$employee->employeeWorkDetail->is_active == 1 ? 'Active' : "Inactive"}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Other Name :</th>
                                                    <td>{{$employee->other_name ? $employee->other_name : "nill" }}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile :</th>
                                                    <td>{{$employee->phone_number ? $employee->phone_number : "nill"}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">DOB :</th>
                                                    <td>{{$employee->dob}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">State :</th>
                                                    <td>{{$employee->state ?  $employee->state->state : "nill"}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Home Town :</th>
                                                    <td>{{$employee->homeTown ?  $employee->homeTown->home_town : "nill"}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Lg :</th>
                                                    <td>{{$employee->lg ?  $employee->lg->lg : "nill"}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row"> Address :</th>
                                                    <td>{{$employee->address ? $employee->address : "nill"}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @else
                                        <h5 class="card-title mb-4">Not Yet Updated</h5>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Pending Projects</p>
                                            <h4 class="mb-0">12</h4>
                                        </div>

                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-hourglass font-size-24"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mini-stats-wid">
                                <div class="card-body">
                                    <div class="media">
                                        <div class="media-body">
                                            <p class="text-muted font-weight-medium">Total Revenue</p>
                                            <h4 class="mb-0">$36,524</h4>
                                        </div>

                                        <div class="avatar-sm align-self-center mini-stat-icon rounded-circle bg-primary">
                                                        <span class="avatar-title">
                                                            <i class="bx bx-package font-size-24"></i>
                                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">Revenue</h4>
                            <div id="revenue-chart" class="apex-charts"></div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4">My Projects</h4>
                            <div class="table-responsive">
                                <table class="table table-nowrap table-hover mb-0">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Projects</th>
                                        <th scope="col">Start Date</th>
                                        <th scope="col">Deadline</th>
                                        <th scope="col">Budget</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>Skote admin UI</td>
                                        <td>2 Sep, 2019</td>
                                        <td>20 Oct, 2019</td>
                                        <td>$506</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">2</th>
                                        <td>Skote admin Logo</td>
                                        <td>1 Sep, 2019</td>
                                        <td>2 Sep, 2019</td>
                                        <td>$94</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">3</th>
                                        <td>Redesign - Landing page</td>
                                        <td>21 Sep, 2019</td>
                                        <td>29 Sep, 2019</td>
                                        <td>$156</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">4</th>
                                        <td>App Landing UI</td>
                                        <td>29 Sep, 2019</td>
                                        <td>04 Oct, 2019</td>
                                        <td>$122</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">5</th>
                                        <td>Blog Template</td>
                                        <td>05 Oct, 2019</td>
                                        <td>16 Oct, 2019</td>
                                        <td>$164</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">6</th>
                                        <td>Redesign - Multipurpose Landing</td>
                                        <td>17 Oct, 2019</td>
                                        <td>05 Nov, 2019</td>
                                        <td>$192</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">7</th>
                                        <td>Logo Branding</td>
                                        <td>04 Nov, 2019</td>
                                        <td>05 Nov, 2019</td>
                                        <td>$94</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
