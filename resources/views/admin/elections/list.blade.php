@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Elections </h3>
            <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol> -->
            </nav>
        </div>
        <div class="row">
            <form action="" method="get">
                <div class="row">

                    <div class="col-md-3">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <div class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                    <input type="text" name="name" class="form-control" value="{{Request::get('name')}}" placeholder="Search name">
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <div class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                    <input type="date" name="date" class="form-control" value="{{Request::get('start_date')}}" placeholder="Search date">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <div class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                    <input type="date" name="date" class="form-control" value="{{Request::get('end_date')}}" placeholder="Search date">
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <ul class="navbar-nav w-100">
                            <li class="nav-item w-100">
                                <div class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                                    <button type="submit" class="btn btn-primary btn-md">Search</button>
                                    <a href="{{url('admin/elections/list')}}" class="btn btn-info mx-3 btn-md">Clear</a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </form>



            @include('message')


            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">Elections List(Total: {{ $getRecord->total() }})</h4>
                        <div class="col-sm-2">
                            <a class="nav-link btn btn-success create-new-button text-black"
                                href="{{ url('admin/elections/add') }}">+ Add new Election</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th> Name</th>
                                        <th> Start_Date </th>
                                        <th> End_Date </th>
                                        <th> Created_date </th>
                                        <th> Actions </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr>

                                            <td style="color:white;"> {{ $value->name }} </td>

                                            <td style="color:white;"> {{ $value->start_date }} </td>
                                            <td style="color:white;"> {{ $value->end_date }} </td>
                                            {{-- <td style="color:white;"> {{ $value->created_at }} </td> --}}
                                            <td style="color:white;"> {{ date('d-m-Y',strtotime($value->created_at)) }} </td>
                                            <td style="color:white;">
                                                <a href="{{ url('admin/elections/edit', $value->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                    <a href="{{ url('admin/elections/delete', $value->id) }}"
                                                        class="btn btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this election?')">Delete</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="float:right;padding:10px;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
