@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Form elements </h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Forms</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Form elements</li>
                </ol>
            </nav>
        </div>
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Candidate Details</h4>
                        @include('message')

                        <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" value="{{ old('name',$getRecord->name) }}" style="color:white"
                                            class="form-control" name="name" required id="exampleInputUsername1"
                                            placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Contact <span
                                                class="text-danger">*</span></label>
                                        <input type="text" required value="{{ old('contact',$getRecord->contact) }}"
                                            style="color:white" class="form-control" name="contact"
                                            id="exampleInputUsername1" placeholder="Contact">
                                    </div>
                                </div>
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





                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                <input type="email" value="{{ old('email',$getRecord->email)}}" style="color:white"
                                    class="form-control" name="email" id="exampleInputEmail1" placeholder="Email">
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                    <label for="exampleInputUsername1">Choose Election</label>
                                    <select name="election" style="color:white" class="form-control" id="exampleInputUsername1">
                                        <option value="{{$getRecord->election}}" class="form-control">Select Election</option>
                                        @foreach ($getElections as $election )
                                        <option value="{{$election->id}}" class="form-control">{{$election->name}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <hr>







                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <button class="btn btn-dark"><a href="{{ url('admin/candidate/list') }}"
                                    class="nav-link">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
