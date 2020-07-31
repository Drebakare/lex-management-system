@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Upload Salary</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Upload Salary</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Salary Upload</h4>
                            <p class="card-title-desc">
                               Kindly fill the following details appropriately
                            </p>
                            @if(empty($employee_salaries))
{{--
                                <form  action="{{route('admin.submit-final-salary')}}" method="post">
--}}
                            <form method="post" action="{{route('user.submit-final-salary', ['token' => $year_month->token])}}">
                                    @csrf
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Surname</th>
                                                <th>Designation</th>
                                                <th>Basic Salary</th>
                                                <th>Absentism</th>
                                                <th>Shortage</th>
                                                <th>Bonus</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($employees as $key => $employee)
                                                <tr>
                                                    <td>{{$employee->surname}}</td>
                                                    <td>{{$employee->employeeWorkDetail->designation->designation}}</td>
                                                    <td class="d-none"><input name="employee_id_{{$key}}" value="{{$employee->id}}" required/></td>
                                                    <td><input name="basic_{{$key}}" type="number" placeholder="Basic Salary"  required/></td>
                                                    <td><input name="absentism_{{$key}}" type="number" placeholder="Absentism"  /></td>
                                                    <td><input name="shortage_{{$key}}" type="number" placeholder="Shortage"  /></td>
                                                    <td><input name="bonus_{{$key}}" type="number" placeholder="Bonus"  /></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <input name="maximum_number" value="{{count($employees)}}" hidden />
                                    <input name="year_month" value="{{$year_month->token}}" hidden />
                                    <div class="table-action-box">
                                        <button class="btn btn-outline-success"><i class="fa fa-check"></i> Process Salary</button>
                                    </div>
                                </form>
                            @else
                                <form method="post" action="{{route('user.update-final-salary', ['token' => $year_month->token])}}">
                                    @csrf
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                        <tr>
                                            <th>Surname</th>
                                            <th>Designation</th>
                                            <th>Basic Salary</th>
                                            <th>Absentism</th>
                                            <th>Shortage</th>
                                            <th>Bonus</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        @foreach($employees as $key => $employee)
                                            <tr>
                                                <td>{{$employee->surname}}</td>
                                                <td>{{$employee->employeeWorkDetail->designation->designation}}</td>
                                                <td class="d-none"><input name="employee_id_{{$key}}" value="{{$employee->id}}" required/></td>
                                                <td><input name="basic_{{$key}}" value="{{$employee_salaries[$key]->basic_salary}}" type="number" placeholder="Basic Salary"  required/></td>
                                                <td><input name="absentism_{{$key}}" value="{{$employee_salaries[$key]->days_absent}}" type="number" placeholder="Absentism"  /></td>
                                                <td><input name="shortage_{{$key}}" value="{{$employee_salaries[$key]->shortage}}" type="number" placeholder="Shortage"  /></td>
                                                <td><input name="bonus_{{$key}}" value="{{$employee_salaries[$key]->bonus}}"  type="number" placeholder="Bonus" /></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <input name="maximum_number" value="{{count($employees)}}" hidden />
                                    <div class="table-action-box">
                                        <button id="submit-button" class="btn btn-outline-success"><i class="fa fa-check"></i> Process Salary</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection


