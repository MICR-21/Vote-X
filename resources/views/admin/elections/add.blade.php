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
                        <h4 class="card-title">Election Details</h4>
                        @include('message')

                        <form class="forms-sample" action="{{ url('admin/elections/add') }}" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" value="{{ old('name') }}" style="color:white"
                                            class="form-control" name="name" id="name"
                                            placeholder="Election Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="description">Description <span class="text-danger">*</span></label>
                                        <textarea style="color:white" class="form-control" name="description"
                                            id="description" placeholder="Description" required>{{ old('description') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                        <input type="date" value="{{ old('start_date') }}" style="color:white"
                                            class="form-control" name="start_date" id="start_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="start_time">Start Time <span class="text-danger">*</span></label>
                                        <input type="time" value="{{ old('start_time') }}" style="color:white"
                                            class="form-control" name="start_time" id="start_time" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="end_date">End Date <span class="text-danger">*</span></label>
                                        <input type="date" value="{{ old('end_date') }}" style="color:white"
                                            class="form-control" name="end_date" id="end_date" required>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="end_time">End Time <span class="text-danger">*</span></label>
                                        <input type="time" value="{{ old('end_time') }}" style="color:white"
                                            class="form-control" name="end_time" id="end_time" required>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                            <a href="{{ url('admin/elections/list') }}" class="btn btn-dark">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>




        </div>
    </div>
@endsection
