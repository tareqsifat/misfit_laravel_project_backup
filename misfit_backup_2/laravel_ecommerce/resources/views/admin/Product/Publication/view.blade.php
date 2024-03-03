@extends('admin.layout.admin')

@section('content')
    <style>
        .card .table td, .card .table th {
            white-space: break-spaces;
        }
    </style>
    <div class="content-wrapper">
        <div class="container-fluid">
            @include('admin.includes.brade_cumb',['title'=>'Size'])
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Size Details</div>
                            <table class="table table-bordered table-hover table-striped">
                                <tr>
                                    <td style="width: 40%">Id</td>
                                    <td>:</td>
                                    <td>{{ $size->id }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">Name</td>
                                    <td>:</td>
                                    <td>{{ $size->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">Creator</td>
                                    <td>:</td>
                                    <td>{{ $size->creator }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 40%">Created at</td>
                                    <td>:</td>
                                    <td>
                                        {{ $size->created_at }}
                                        
                                    </td>
                                    <tr>
                                        <td style="width: 40%">Status</td>
                                        <td>:</td>
                                        <td>{{ $size->status }}</td>
                                    </tr>
                                </tr>
                                <tr>
                                    
                                </tr>
                            </table>
                            <div class="card-footer  d-flex justify-content-between">
                                <div>
                                </div>
                                <div>
                                    <a href="{{ route('size.index') }}" 
                                    class="btn btn-warning">
                                    <i class="fa fa-check"></i>
                                    <span>Ok</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--start overlay-->
            <div class="overlay"></div>
            <!--end overlay-->
        </div>
        <!-- End container-fluid-->
    </div>
    <!--End content-wrapper-->

@endsection



