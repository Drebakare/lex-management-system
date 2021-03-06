@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Create Home Town</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Create Home Town</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add a New Home Town</h4>
                            <p class="card-title-desc">Fill all information below. Ensure all fields are filled Properly as deleting will not be possible after add new store</p>
                            <form method="post" action="{{route('user.submit-home-town')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Home Town</label>
                                            <input id="productname" name="home_town" type="text" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="productname">Select State</label>
                                            <select name="state" class="form-control" required>
                                                @foreach($states as $state)
                                                    <option value="{{$state->id}}" {{--@if($user->store_id == $store->id) selected @endif--}}>{{$state->state}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Add Home Town</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Home Town</h4>
                            <p class="card-title-desc">
                                All Home Town
                            </p>
                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Reference</th>
                                        <th>Home Town</th>
                                        <th>State</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($homes as $key => $home)
                                    <tr>
                                        <td>{{$home->id}}</td>
                                        <td>{{$home->token}}</td>
                                        <td>{{$home->home_town}}</td>
                                        <td>{{$home->state->state}}</td>
                                        <td>{{$home->created_at}}</td>
                                        <td><button class="btn btn-sm btn-outline-primary waves-effect waves-light" data-toggle="modal" data-target="#edit-homes-{{$key}}"> Edit</button></td>
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
    @foreach($homes as $key => $home)
        <div class="modal fade" id="edit-homes-{{$key}}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="mySmallModalLabel">Edit Home Town</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Edit Home Town</h4>
                    <p class="card-title-desc">Fill all information below correct.</p>
                    <form method="post" action="{{route('user.edit-home-town-details', ['token' => $home->token])}}">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Home Town</label>
                                    <input id="productname" value="{{$home->home_town}}" name="home_town" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="productname">Select State</label>
                                    <select name="state" class="form-control" required>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" @if($home->state_id == $state->id) selected @endif>{{$state->state}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success mr-1 waves-effect waves-light">Edit Home Town</button>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    @endforeach
@endsection
