@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Bank</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Bank</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{--<div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add a New Role</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after add new store</p>
                            <form method="post" action="{{route('user.submit-role')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Role</label>
                                            <input id="productname" name="role" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add Role</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>--}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Banks</h4>
                            <p class="card-title-desc">
                                Accepted Banks
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reference</th>
                                        <th>Bank</th>
                                        <th>Code</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($banks as $key => $bank)
                                    <tr>
                                        <td>{{$bank->id}}</td>
                                        <td>{{$bank->token}}</td>
                                        <td>{{$bank->bank}}</td>
                                        <td>{{$bank->code}}</td>
                                        <td>{{$bank->status == 1 ? 'Active' : "Disable"}}</td>
                                        <td>{{$bank->created_at}}</td>
                                        <td>
                                            @if($bank->status == 1)
                                                <a href="{{route('user.deactivate-bank', ['token' => $bank->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Deactivate Bank">
                                                        <i class="mdi mdi-close-thick mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="{{route('user.activate-bank', ['token' => $bank->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Activate Bank">
                                                        <i class="mdi mdi-check-outline mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    {{--@foreach($roles as $key => $role)
        <div class="modal fade" id="edit-role-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Role</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('user.edit-role-details', ['token' => $role->token])}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Role</label>
                                    <input id="productname" value="{{$role->role}}" name="role" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Role</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach--}}
@endsection
