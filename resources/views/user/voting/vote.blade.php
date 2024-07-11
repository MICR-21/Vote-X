@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Candidate details</h4>
                        @include('message')

                        <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="items-center justify-center my-5">
                            <img class="img-lg"
     src="{{ $getRecord->profile_pic ? asset($getRecord->profile_pic) : asset('images/happy.png') }}"
     alt="">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleInputUsername1">Name <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" value="{{ old('name',$getRecord->name)}}" style="color:white"
                                            class="form-control" name="name"  id="exampleInputUsername1"
                                            placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <input type="hidden" value="{{ old('candidate_id',$getRecord->name)}}" style="color:white"
                                            class="form-control" name="candidate_id"  id="exampleInputUsername1"
                                            placeholder="Id">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <input type="hidden" value="{{ old('name',$getRecord->id)}}" style="color:white"
                                            class="form-control" name="name"  id="exampleInputUsername1"
                                            placeholder="Username">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <input type="hidden"  value="{{ old('voter_id',Auth::user()->voter_id)}}" style="color:white"
                                            class="form-control" name="voter_id"  id="exampleInputUsername1"
                                            placeholder="voter_id">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">

                                        <input type="hidden"  value="{{ old('election',$getRecord->election)}}" style="color:white"
                                            class="form-control" name="election"  id="exampleInputUsername1"
                                            placeholder="election">
                                    </div>
                                </div>

                            </div>



                            <button type="submit" class="btn btn-primary me-2">Vote</button>
                            <button class="btn btn-dark"><a href="{{ url('admin/user/list') }}"
                                    class="nav-link">Cancel</a></button>
                        </form>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
