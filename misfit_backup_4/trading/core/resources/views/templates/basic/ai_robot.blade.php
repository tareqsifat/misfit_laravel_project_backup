@extends($activeTemplate . 'layouts.frontend')
<style>
    .bg-overlay {
        background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url("https://cdn-akebd.nitrocdn.com/bCWGvmHIgAlrWzdjLoGQbzvNeZiguKmJ/assets/images/optimized/rev-5c7fb2d/www.jeffbullas.com/wp-content/uploads/2023/04/AI-robot.jpg");
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center center;
        color: #fff;
        height: 450px;
        padding-top: 50px;
    }

</style>
@section('content')
    <section class="my-3">
        <div class="container bg-overlay">
            <div class="col-md-8 mx-auto">
            	<div class="row text-center">
            		    Experience the power of A.I. Robots in action as they operate fully automated trading rooms, leveraging cutting-edge neural networks to make informed trades. Observe in real-time as the A.I. Robots expertly select equities and execute paper trades with precision. Are you interested in trading with A.I. Robots? It's easy - simply click on the "Pricing" button located in the top right corner of the screen to subscribe. Let's dive into the details of using A.I. Robots for trading.
                    <br><br>
                    <div class="d-flex justify-content-between">
                        <form method="POST" action="{{ route('ai_robot_update') }}">
                            @csrf
                            @if($ai_robot_status->ai_robot == 'active')
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="ai_status" value="1" role="switch" id="ai_check" @if($user->ai_robot) checked @endif>
                                <input type="hidden" name="userId" value="{{ $user->id }}">
                            </div>
                            @else
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" value="1" role="switch" id="ai_check" disabled>
                            </div>
                            @endif
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        
                        <!--<div>-->
                        <!--    <h3 class="text-success">2.16</h3>-->
                        <!--    <h5>Today Profit</h5>-->
                        <!--</div>-->
                    </div>
                    <div>
                        <h5>Lock Amount: <b class="text-danger">{{ $user->lock_amount }}$</b></h5>
                    </div>
            	</div>
            </div>
        </div>
    </section>
@endsection
