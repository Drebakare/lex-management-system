@extends('app')
@section('contents')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Add User</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('user.dashboard')}}">Dashboards</a></li>
                                <li class="breadcrumb-item active">Add User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">User's Information</h4>
                            <h6>Kindly supply correct information</h6>
                            <form method="post" action="{{route('user.submit-new-user-form')}}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="manufacturerbrand">Email Address</label>
                                            <input name="email" id="manufacturerbrand"  type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="manufacturerbrand">Password</label>
                                            <input name="password" id="manufacturerbrand"  type="password" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Store</label>
                                            <select name="store" class="form-control select2" required>
                                                <option value="">Select Store</option>
                                                @foreach($stores as $store)
                                                    <option value="{{$store->id}}">{{$store->store}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Department</label>
                                            <select name="department" class="form-control select2" required>
                                                <option value="">Select User's Department</option>
                                                @foreach($departments as $department)
                                                    <option value="{{$department->id}}" >{{$department->department}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Role</label>
                                            <select name="role" class="form-control select2" required>
                                                <option value="">Select User's Role</option>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}" @if($role->id == 1) disabled @endif>{{$role->role}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        {{--   <div class="form-group">
                                                <label class="control-label">Category</label>
                                               <select class="form-control select2">
                                                   <option>Select</option>
                                                   <option value="AK">Alaska</option>
                                                   <option value="HI">Hawaii</option>
                                               </select>
                                           </div>
                                           <div class="form-group">
                                               <label class="control-label">Features</label>
                                               <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                   <option value="AK">Alaska</option>
                                                   <option value="HI">Hawaii</option>
                                                   <option value="CA">California</option>
                                                   <option value="NV">Nevada</option>
                                                   <option value="OR">Oregon</option>
                                                   <option value="WA">Washington</option>
                                               </select>

                                           </div>
                                           <div class="form-group">
                                               <label for="productdesc">Product Description</label>
                                               <textarea class="form-control" id="productdesc" rows="5"></textarea>
                                           </div>
   --}}
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-success mr-1 waves-effect waves-light">Add User</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
