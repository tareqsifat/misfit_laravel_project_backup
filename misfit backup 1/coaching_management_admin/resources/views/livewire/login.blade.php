{{-- <div class="login_bg">
    <div class="container">
        <div class="row d-flex justify-content-center align-items-center">
            
            <div class="card">



                <div class="user text-center">

                    <div class="profile">

                        <img src="{{ asset('frontend/assets/images/camera_icon.png') }}"
                            class="bg-white rounded-circle box_shadow" width="80">

                    </div>

                </div>


                <div class="mt-5 ms-2 me-2 text-center">
                    <form wire:submit.prevent="login_submit" action="">
                        <div class="form-group mb-4 pt-5">
                            <div class="input-group mb-2">
                                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-user"></i></span>
                                <input wire:model="email" type="email" class="form-control" name="email" aria-label="Sizing example input"
                                    aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="inputGroup-sizing-default"><i class="fa-solid fa-lock"></i></span>
                                <input wire:model="password" type="password" class="form-control gray_color"
                                name="password">
                            </div>
                        </div>

                        <div class="d-grid gap-2 pb-5">
                            <button class="btn btn-success pt-2 pb-2 purple_color">Login</button>
                        </div>
                    </form>

                </div>
                
                
            </div>
        </div>
    </div>
</div> --}}

<section class="login_page">
    <div class="container">
        <div class="login_page_content">

            <!-- form area start -->
            <form wire:submit.prevent="login_submit" action="#">
                <div class="input_area user_name_area">
                    <i class="fa-solid fa-user"></i>
                    <input wire:model="email" type="email" name="email" placeholder="Email">
                </div>
                <div class="input_area password_area">
                    <i class="fa-solid fa-unlock-keyhole"></i>
                    <input wire:model="password" type="password" placeholder=".........................">
                </div>
                <button type="submit" class="button_area login_button">LOGIN</button>
                {{-- <button class="button_area register_button">GET REGISTERED</button> --}}
            </form>
            <!-- form area end -->

            <!-- camera_icon area start -->
            <div class="camera_icon">
                <i class="fa-solid fa-camera"></i>
            </div>
            <!-- camera_icon area end -->
        </div>
    </div>
</section>