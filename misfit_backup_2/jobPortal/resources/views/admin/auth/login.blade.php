@extends('admin.auth.layout.index')

@section('content')
            <input type="hidden" name="" class="login_error" value="{{ \Illuminate\Support\Facades\Session::get('error') }}">
            <div class="container-fluid">
                <div class="row d-flex justify-content-center align-content-center">
                    <!-- left column -->
                    <div class="col-md-6" style="padding-top: 40px">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Admin Login</h3>
                            </div>
                            <form action="{{ route('admin_login') }}" method="POST">
                                <div class="card-body">
                                    @csrf
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" required placeholder="Enter email" value="{{old('email')}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password" id="exampleInputPassword1" required placeholder="Password">
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    @if(\Illuminate\Support\Facades\Session::has('error'))
        @push('js')
            <script>
                let error = $('.login_error').val();
                console.log(error)
                s_alert(error, 'error');
            </script>
        @endpush
    @endif

@endsection
