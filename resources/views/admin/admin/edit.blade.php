@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Admin</h4>

                        <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputUsername1">Username</label>
                                <input value="{{ old('name',$getRecord->name)}}" type="text" style="color:white" class="form-control" name="name"" id="exampleInputUsername1"
                                    placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" value="{{ old('email',$getRecord->email)}}" style="color:white" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email">
                                <p class="text-danger">{{$errors->first('email')}}</p>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" style="color:white" class="form-control" name="password" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Profile Pic<span class="text-danger">*</span>
                                        </label>
                                        <input type="file" value="{{ old('profile_pic') }}" style="color:white"
                                            class="form-control" name="profile_pic" id="exampleInputUsername1"
                                            placeholder="">
                                    </div>
                            </div>


                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-dark"><a href="{{url('admin/admin/list')}}" class="nav-link">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
