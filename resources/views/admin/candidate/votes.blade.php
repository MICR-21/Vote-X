@extends('layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> votes </h3>
            <nav aria-label="breadcrumb">
                <!-- <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Tables</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
                </ol> -->
            </nav>
        </div>
        <div class="row">
            



            @include('message')


            <div class="col-lg-12 grid-margin stretch-card">

                <div class="card">

                    <div class="card-body">
                        <h4 class="card-title">Votes(Total: {{ $getRecord->total() }})</h4>
                        

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        
                                        
                                        <th> uniquikey </th>
                                        <th> Created_date </th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                        <tr>

                                            <td style="color:white;"> {{ $value->voter_id }} </td>
                                            {{-- <td style="color:white;"> {{ $value->created_at }} </td> --}}
                                            <td style="color:white;"> {{ date('d-m-Y',strtotime($value->created_at)) }} </td>
                                            

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
