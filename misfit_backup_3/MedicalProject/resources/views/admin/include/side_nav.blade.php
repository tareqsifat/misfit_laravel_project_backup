<nav class="side-nav">
    <a href="{{ route('admin_index') }}" class="intro-x flex items-center pl-5 pt-4">
        <img alt="Rubick Tailwind HTML Admin Template" class="w-6" src="{{ asset('contents/admin') }}/dist/images/logo.svg">
        <span class="hidden xl:block text-white text-lg ml-3"> Ru<span class="font-medium">bick</span> </span>
    </a>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <li>
            <a href="{{ route('admin_index') }}" class="side-menu {{ Request::is('admin/admin') ? 'side-menu--active' : '' }} ">
                <div class="side-menu__icon"> <i data-feather="home"></i> </div>
                <div class="side-menu__title">
                    Dashboard 
                    <div class="side-menu__sub-icon transform rotate-180"> <i ></i> </div>
                </div>
            </a>
        </li>
        <li>
            <a href="" class="side-menu">
                <div class="side-menu__icon"> <i data-feather="file-text"></i> </div>
                <div class="side-menu__title"> Post </div>
            </a>
        </li>
        <li>
            <a href="{{ route('user_index') }}" class="side-menu {{ Request::is('admin/user') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="users"></i> </div>
                <div class="side-menu__title">
                    Users 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('category.index') }}" class="side-menu {{ Request::is('admin/category') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="icon-medical-social-services"></i> </div>
                <div class="side-menu__title">
                    category 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('send_email_index') }}" class="side-menu {{ Request::is('admin/send_email') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="icon-medical-health-services"></i> </div>
                <div class="side-menu__title">
                     Contact Messages 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('treatment.index') }}" class="side-menu {{ Request::is('admin/treatment') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="icon-medical-health-services"></i> </div>
                <div class="side-menu__title">
                    Treatments 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('reply.index') }}" class="side-menu {{ Request::is('reply') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="icon-reply"></i> </div>
                <div class="side-menu__title">
                    reply 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('comments.index') }}" class="side-menu {{ Request::is('comments') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="icon-comment"></i> </div>
                <div class="side-menu__title">
                    Comments 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('departments.index') }}" class="side-menu {{ Request::is('admin/departments') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-building"></i> </div>
                <div class="side-menu__title">
                    Department 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('doctors.index') }}" class="side-menu {{ Request::is('admin/doctors') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-user-md"></i> </div>
                <div class="side-menu__title">
                    Doctors
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('appoint_page.index') }}" class="side-menu {{ Request::is('admin/appoint_page') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-calendar-check"></i> </div>
                <div class="side-menu__title">
                    Appontment Pages
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('appoint_que.index') }}" class="side-menu {{ Request::is('admin/appoint_que') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-question-circle"></i> </div>
                <div class="side-menu__title">
                    Appontment Questions
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('opening_hour.index') }}" class="side-menu {{ Request::is('admin/opening_hour') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-clock"></i> </div>
                <div class="side-menu__title">
                    Opening Hour 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('subcategory.index') }}" class="side-menu {{ Request::is('admin/subcategory') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i data-feather="activity"></i> </div>
                <div class="side-menu__title">
                    SubCategory 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('blogs.index') }}" class="side-menu {{ Request::is('admin/blogs') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-blog"></i> </div>
                <div class="side-menu__title">
                    Blog 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('slider.index') }}" class="side-menu {{ Request::is('admin/slider') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fas fa-sliders-h"></i> </div>
                <div class="side-menu__title">
                    Slider
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('service.index') }}" class="side-menu {{ Request::is('admin/service') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fab fa-servicestack"></i> </div>
                <div class="side-menu__title">
                    Service
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('appointments_index') }}" class="side-menu {{ Request::is('admin/appointments') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-calendar-check"></i> </div>
                <div class="side-menu__title">
                    Book an Appointment
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('testimonial.index') }}" class="side-menu {{ Request::is('admin/testimonial') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-comment-dots"></i> </div>
                <div class="side-menu__title">
                    Testimonial
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('faqs.index') }}" class="side-menu {{ Request::is('admin/faqs') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa fa-question-circle" aria-hidden="true"></i> </div>
                <div class="side-menu__title">
                    FAQ 
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('subscribe.index') }}" class="side-menu {{ Request::is('subscribe') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="fa fa-users" aria-hidden="true"></i>  </div>
                <div class="side-menu__title">
                    Subscribe
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('ourwork.index') }}" class="side-menu {{ Request::is('admin/ourwork') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="icon-medical-social-services"></i>  </div>
                <div class="side-menu__title">
                    OurWork
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
            <a href="{{ route('footer.index') }}" class="side-menu {{ Request::is('admin/footer') ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fas fa-users-cog"></i> </div>
                <div class="side-menu__title">
                    Footer
                    <div class="side-menu__sub-icon "> <i ></i> </div>
                </div>
            </a>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li>
            <form id="logout-form" class="side-menu" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                <button type="submit"><i class="icon-line-log-out"></i> Log out</button>
            </form>
        </li>
    </ul>
</nav>