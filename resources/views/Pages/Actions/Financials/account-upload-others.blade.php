@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Upload Other Salary Breakdown</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Upload Other Salary Breakdown</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Other Salary BreakDown Upload</h4>
                            <p class="card-title-desc">
                               Kindly fill the following details appropriately
                            </p>
                            <form method="post" action="{{route('user.account-final-salary'/*, ['token' => $year_month->token]*/)}}">
                                @csrf
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Surname</th>
                                            <th>Designation</th>
                                            <th class="d-none">token</th>
                                            <th>Basic Salary</th>
                                            <th>Savings</th>
                                            <th>Loan</th>
                                            <th>Card</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($salaries as $key => $salary)
                                            <tr>
                                                <td>{{$salary->employee->surname}}</td>
                                                <td>{{$salary->employee->employeeWorkDetail->designation->designation}}</td>
                                                <td class="d-none"><input name="token_{{$key}}" value="{{$salary->token}}" required/></td>
                                                <td><input name="basic_{{$key}}" type="number" value="{{$salary->basic_salary}}" placeholder="Basic Salary" disabled/></td>
                                                <td><input name="saving_{{$key}}" type="number" value="{{$salary->savings}}" placeholder="Savings"  required/></td>
                                                <td><input name="loan_{{$key}}" type="number" value="{{$salary->loan}}" placeholder="Loan"  required/></td>
                                                <td><input name="card_{{$key}}" type="number" value="{{$salary->card}}" placeholder="Sim Card" required /></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <input name="maximum_number" value="{{count($salaries)}}" hidden />
{{--
                                <input name="year_month" value="{{$year_month->token}}" hidden />
--}}
                                <div class="table-action-box">
                                    <button class="btn btn-outline-success"><i class="fa fa-check"></i> Process Salary</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
@endsection


