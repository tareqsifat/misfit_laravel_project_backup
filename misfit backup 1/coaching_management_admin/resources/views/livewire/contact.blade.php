<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <div class="contact_area">
        <!-- contact_area_title start -->
        <section class="contact_area_title">
            <div class="container">
                <div class="contact_area_title_content">
                    <h2>contact us</h2>
                </div>
            </div>
        </section>
        <!--contact_area_title end -->

        <!-- contact_area_content start -->
        <section class="contact_area_content">
            <div class="container">
                <div class="contact_area_content_details">
                    <div class="row">
                        <div class="col-12">
                            @if ($feedback_message)    
                                <div class="form-message mt-2">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ $feedback_message }}</strong>
                                        <button type="button" onclick="closeAlert()" class="btn-close" aria-label="Close"><i class="icon fa fa-close"></i></button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <!-- contact_area_left start -->
                        <div class="col-md-6">
                            <div class="contact_area_left">
                                <!-- address_area start -->
                                <div class="address_area">
                                    <div class="title address_title">
                                        <div class="title_icon">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </div>
                                        <h2>address</h2>
                                    </div>
                                    <div class="item_value address_details">
                                        <a href="#">
                                            <span>mirpur-1</span>
                                            <br>
                                            <span>dhaka-1212,</span>

                                            <span>bangladesh</span>
                                        </a>
                                    </div>
                                </div>
                                <!-- address_area end -->
                                <!-- phone_area start -->
                                <div class="phone_area">
                                    <div class="title phone_title">
                                        <div class="title_icon">
                                            <i class="fa-brands fa-whatsapp"></i>
                                        </div>
                                        <h2>call us</h2>
                                    </div>
                                    <div class="item_value phone_number">
                                        <a class="item_a" href="#">
                                            +88 01799999999
                                        </a>
                                        <a class="item_a" href="#">
                                            +88 01700000000
                                        </a>
                                    </div>
                                </div>
                                <!-- phone_area end -->
                                <!-- email_area start -->
                                <div class="email_area">
                                    <div class="title email_title">
                                        <div class="title_icon">
                                            <i class="fa-regular fa-paper-plane"></i>
                                        </div>
                                        <h2>email</h2>
                                    </div>
                                    <div class="item_value email_address">
                                        <a class="item_a" href="#">
                                            abcdrast@gmail.com
                                        </a>

                                    </div>
                                </div>
                                <!-- email_area end -->
                                <!-- social_link_area start -->
                                <div class="social_link_area">
                                    <div class="title social_link_title">
                                        <div class="title_icon">
                                            <i class="fa-solid fa-globe"></i>
                                        </div>
                                        <h2>social link</h2>
                                    </div>
                                    <div class="item_value social_link">
                                        <ul>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-linkedin-in"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-dribbble"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <i class="fa-brands fa-github"></i>
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <!-- social_link_area end -->
                            </div>
                        </div>
                        <!-- contact_area_left end -->
                        <!-- contact_area_right start -->
                        <div class="col-md-6">
                            <div class="contact_area_right">
                                <form action="#" method="post" wire:submit.prevent="contact_submit">
                                    <!-- user_name_area start -->
                                    <div class="email_area">
                                        <div class="email">
                                            <label class="label_all" for="#">Name</label>
                                            <input class="input_all"  wire:model="full_name" name="full_name" type="text" placeholder="Your Name">
                                        </div>
                                    </div>
                                    <!-- user_name_area end -->
                                    <!-- email_area start -->
                                    <div class="email_area">
                                        <div class="email">
                                            <label class="label_all" for="#">email</label>
                                            <input class="input_all" wire:model="email" name="email" type="email" placeholder="Your Email">
                                        </div>
                                    </div>
                                    <!-- email_area end -->
                                    <!--message_area start -->
                                    <div class="message_area">
                                        <div class="message">
                                            <label class="label_all" for="#">message</label>
                                            <textarea name="message"  wire:model="message" id="message" cols="30" rows="10"
                                                placeholder="Your Message"></textarea>
                                        </div>
                                    </div>
                                    <!-- message_area end -->
                                    <!--submit_area start -->
                                    <div class="submit_button_area">
                                        <button>
                                            <span class="button_icon"><i class="fa-regular fa-paper-plane"></i></span>
                                            <span class="button_title">submit</span>
                                        </button>
                                    </div>
                                    <!--submit_area end -->
                                </form>
                            </div>
                        </div>
                        <!-- contact_area_right end -->
                    </div>
                </div>
            </div>
        </section>
        <!-- contact_area_content end -->
        <!-- map_area start -->
        <section class="map_area">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.2463712202643!2d90.35703132503642!3d23.809836643053394!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c1670cdb1779%3A0x645bbf4f0aeb1d56!2sTech%20Park%20IT!5e0!3m2!1sen!2sbd!4v1678988072303!5m2!1sen!2sbd"
                width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
        <!-- map_area end -->
        
    </div>
</div>
