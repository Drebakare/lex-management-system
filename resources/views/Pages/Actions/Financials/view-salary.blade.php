@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Salary Breakdown</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Salary Breakdown</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Salary BreakDown Upload</h4>
                            <p class="card-title-desc">
                               Employee Salary Break Down
                            </p>
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-centered table-nowrap mb-0" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>Designation</th>
                                        <th>Sales</th>
                                        <th>Basic</th>
                                        <th>Bonus</th>
                                        <th>Tax</th>
                                        <th>Pension</th>
                                        <th>ABS/SHT/LN/CD</th>
                                        <th>Net Payment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($salaries as $key => $salary)
                                        <tr>
                                            <td>{{$salary->employee->employeeWorkDetail->department->department}}</td>
                                            <td>{{$salary->employee->surname. " " . $salary->employee->first_name}}</td>
                                            <td>{{$salary->employee->employeeWorkDetail->designation->designation}}</td>
                                            <td>{{$salary->sales}}</td>
                                            <td>{{number_format($salary->basic_salary)}}</td>
                                            <td>{{number_format($salary->bonus)}}</td>
                                            <td>{{number_format($salary->tax_paid)}}</td>
                                            <td>{{number_format($salary->pension_paid)}}</td>
                                            <td>
                                                abs={{number_format($salary->absentism)}}, sht={{number_format($salary->shortage)}}, ln={{number_format($salary->loan)}}, cd={{number_format($salary->card)}}
                                            </td>
                                            <td>
                                                {{number_format(($salary->basic_salary+$salary->bonus) - ($salary->tax_paid+$salary->pension_paid+$salary->absentism+$salary->shortage+$salary->loan+$salary->card))}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection


