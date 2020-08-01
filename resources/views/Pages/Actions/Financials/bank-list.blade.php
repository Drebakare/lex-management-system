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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <h4 class="float-right font-size-16">   </h4>
                                <div class="mb-4">
                                    {{--<img src="assets/images/logo-dark.png" alt="logo" height="20"/>--}}
                                    <h4>Lexican Salary List</h4>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-6">
                                    <address>
                                        <strong>Address:</strong><br>
                                        48, Ola Lay-Out,<br>
                                        Ile Ife, Ife Central,<br>
                                        Osun, Nigeria<br>
                                    </address>
                                </div>
                                <div class="col-sm-6 text-sm-right">
                                    <address class="mt-2 mt-sm-0">
                                        <strong>Dated:</strong><br>
                                        {{\Carbon\Carbon::now()}}
                                    </address>
                                </div>
                            </div>
{{--
                            <div class="row">
                                <div class="col-sm-6 mt-3">
                                    <address>
                                        <strong>Payment Method:</strong><br>
                                        Visa ending **** 4242<br>
                                        jsmith@email.com
                                    </address>
                                </div>
                                <div class="col-sm-6 mt-3 text-sm-right">
                                    <address>
                                        <strong>Order Date:</strong><br>
                                        October 16, 2019<br><br>
                                    </address>
                                </div>
                            </div>
--}}
                            <div class="py-2 mt-3">
                                <h3 class="font-size-15 font-weight-bold">Salary Bank List For {{\Carbon\Carbon::now()->subRealMonth()->format('F')}}</h3>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th {{--style="width: 70px;"--}}>Name</th>
                                        <th {{--style="width: 70px;"--}}>Account No</th>
                                        <th {{--style="width: 70px;"--}}>Bank</th>
                                        <th class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($salaries as $salary)
                                        <tr>
                                            <td>{{$salary->employee->title->title}}</td>
                                            <td>{{$salary->employee->surname . ' ' . $salary->employee->first_name}}</td>
                                            <td>{{$salary->employee->bvn->account_number}}</td>
                                            <td>{{$salary->employee->bvn->bank}}</td>
                                            <td class="text-right">{{number_format(($salary->basic_salary+$salary->bonus) - ($salary->tax_paid+$salary->pension_paid+$salary->absentism+$salary->shortage+$salary->loan+$salary->card))}}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" class="text-right">Sub Total</td>
                                        <td class="text-right">
                                            ₦{{number_format($total)}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="border-0 text-right">
                                            <strong>Total</strong></td>
                                        <td class="border-0 text-right"><h4 class="m-0">₦{{number_format($total)}}</h4></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-print-none">
                                <div class="float-right">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


