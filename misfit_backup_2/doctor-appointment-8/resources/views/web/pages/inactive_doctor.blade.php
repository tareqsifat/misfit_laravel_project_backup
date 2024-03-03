@extends('web.app.app')


@section('main-body')
    <p style="height: 150px;"> abc</p>
    <div class="card text-center" style="background-color:#cdbc8b">
        <div class="card-header">
            Waiting for Approval
        </div>
        <div class="card-body">
            <h5 class="card-title">Your Account is not approved yet</h5>
            <p class="card-text">Please wait super admin approve your account</p>
            <a href="{{url('/')}}" class="btn btn-primary">Go Home</a>
        </div>
    </div>
@endsection
