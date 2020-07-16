@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">View Users</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">View Users</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Users</h4>
                            <p class="card-title-desc">
                                View all users on lexican Management System
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Department</th>
                                    <th>Store</th>
                                    <th>Activeness</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach($users as $key => $user)
                                    <tr>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            {{$user->role->role}}
                                        </td>
                                        <td>
                                            {{$user->department_id != null ? $user->department->department : "Nill" }}
                                        </td>
                                        <td>
                                            {{$user->store_id != null ? $user->store->store : "Nill" }}
                                        </td>
                                        <td>
                                            @if($user->status == 1)
                                                Active
                                            @else
                                                Inactive
                                            @endif
                                        </td>
                                        <td>
                                            {{$user->created_at}}
                                        </td>
                                        <td>

                                            @if($user->status == 1)
                                                <a href="{{route('user.suspend-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Suspend User">
                                                        <i class="mdi mdi-close-thick mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="{{route('user.activate-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Activate User">
                                                        <i class="mdi mdi-check-outline mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <a href="#edit-user-{{$key}}" data-toggle="modal" >
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit User's Role">
                                                    <i class="mdi mdi-account-convert mdi-24px"></i>
                                                </span>
                                            </a>
                                            {{--@if($user->role_id == 1)
                                                <a href="#edit-user-{{$key}}" data-toggle="modal" >
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Edit User's Membership Level">
                                                        <i class="mdi mdi-account-convert mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif
                                            <a href="{{route('admin.view-user-details', ['token' => $user->token])}}">
                                                <span data-toggle="tooltip" data-placement="top" title data-original-title="View User's Details">
                                                    <i class="mdi mdi-eye-circle mdi-24px"></i>
                                                </span>
                                            </a>
                                            @if($user->active == 1)
                                                <a href="{{route('admin.suspend-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Suspend User">
                                                        <i class="mdi mdi-close-thick mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @else
                                                <a href="{{route('admin.activate-user', ['token' => $user->token])}}">
                                                    <span data-toggle="tooltip" data-placement="top" title data-original-title="Activate User">
                                                        <i class="mdi mdi-check-outline mdi-24px"></i>
                                                    </span>
                                                </a>
                                            @endif--}}
{{--
                                            <button class="btn btn-sm btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#edit-store-{{$key}}"> Edit</button>
--}}
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
    @foreach($users as $key => $user)
        <div class="modal fade" id="edit-user-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit User's Membership Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Membership Level</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('user.edit-user-details', ['token' => $user->token])}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">User Email</label>
                                    <input id="productname" value="{{$user->email}}" name="store_name" type="text" class="form-control" required disabled>
                                </div>
                            </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="productname">Update Role</label>
                                        <select name="role" class="form-control" required>
                                            @foreach($roles as $role)
                                                <option value="{{$role->id}}" @if($user->role_id == $role->id) selected @endif>{{$role->role}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="productname">Update Department</label>
                                        <select name="department" class="form-control" required>
                                            @foreach($departments as $department)
                                                <option value="{{$department->id}}" @if($user->department_id == $department->id) selected @endif>{{$department->department}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="productname">Update Store</label>
                                        <select name="store" class="form-control" required>
                                            @foreach($stores as $store)
                                                <option value="{{$store->id}}" @if($user->store_id == $store->id) selected @endif>{{$store->store}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit User Details</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
