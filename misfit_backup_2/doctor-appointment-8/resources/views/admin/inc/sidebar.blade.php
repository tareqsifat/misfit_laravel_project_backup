

@if(Auth::user()->role == 0)
<div id="sidebar-menu" style="background-color: #2E3B4E; border-radius: 0 10px 10px 0;">
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled" id="side-menu">
        <li class="menu-title" key="t-menu" style="font-size: 18px; font-weight: 1000; color: #fff;">Menu</li>

        {{-- Appointments --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5733;">
                <i class="bx bx-home-circle"></i>
                <span key="t-loation">Appointments</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('appointment.index') }}" key="t-create" style="font-size: 14px; color: #fff;">All Appointment</a></li>
            </ul>
        </li>
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5733;">
                <i class="bx bx-home-circle"></i>
                <span key="t-loation">Pending Doctors</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('pending-doctor-list') }}" key="t-create" style="font-size: 14px; color: #fff;">All Pending Doctors</a></li>
            </ul>
        </li>
        {{-- End - Appointments --}}


        {{-- Appointments --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5733;">
                <i class="bx bx-home-circle"></i>
                <span key="t-loation">Patient Chats</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('get.patient.chat') }}" key="t-create" style="font-size: 14px; color: #fff;">Chats</a></li>
            </ul>
        </li>
        {{-- End - Appointments --}}

        <li class="menu-title" key="t-menu" style="font-size: 18px; font-weight: 1000; color: #fff;">Web Contents</li>

        {{-- Availability --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #009688;">
                <i class="bx bx-home-circle"></i>
                <span key="t-availablity">Availability</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('availabilities.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All Availability</a></li>
                <li><a href="{{ route('availabilities.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Availability</a></li>
            </ul>
        </li>
        {{-- End - Availability --}}

        {{-- Chamber Location --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #E91E63;">
                <i class="bx bx-home-circle"></i>
                <span key="t-loation">Chamber Location</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('locations.index') }}" key="t-list" style="font-size: 14px; color: #fff;">List Chamber Location</a></li>
                <li><a href="{{ route('locations.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Chamber Location</a></li>
            </ul>
        </li>
        {{-- End - Chamber Location --}}

        {{-- Service --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #673AB7;">
                <i class="bx bx-home-circle"></i>
                <span key="t-service">Service</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('services.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All Service</a></li>
                <li><a href="{{ route('services.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Service</a></li>
            </ul>
        </li>
        {{-- End - Service --}}

        {{-- Testimonial --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FFC107;">
                <i class="bx bx-home-circle"></i>
                <span key="t-testimonial">Testimonial</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('testimonials.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All Testimonial</a></li>
                <li><a href="{{ route('testimonials.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Testimonial</a></li>
            </ul>
        </li>
        {{-- End - Testimonial --}}

        {{-- Hero --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #3F51B5;">
                <i class="bx bx-home-circle"></i>
                <span key="t-hero">Hero</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('heros.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All Hero</a></li>
                <li><a href="{{ route('heros.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Hero</a></li>
            </ul>
        </li>
        {{-- End - Hero --}}

        {{-- Blog --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #009688;">
                <i class="bx bx-home-circle"></i>
                <span key="t-blog">Blog</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('blogs.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All Blog</a></li>
                <li><a href="{{ route('blogs.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create Blog</a></li>
            </ul>
        </li>
        {{-- End - Blog --}}

        {{-- FAQ --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #E91E63;">
                <i class="bx bx-home-circle"></i>
                <span key="t-faq">FAQ</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('faqs.index') }}" key="t-list" style="font-size: 14px; color: #fff;">All FAQ</a></li>
                <li><a href="{{ route('faqs.create') }}" key="t-create" style="font-size: 14px; color: #fff;">Create FAQ</a></li>
            </ul>
        </li>
        {{-- End - FAQ --}}

        {{-- Website Content --}}
        <li>
            <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5722;">
                <i class="bx bx-home-circle"></i>
                <span key="t-hero">Website Content</span>
            </a>
            <ul class="sub-menu" aria-expanded="false">
                <li><a href="{{ route('about.edit', 1) }}" key="t-list" style="font-size: 14px; color: #fff;">About Us</a></li>
                <li><a href="{{ route('contact.edit', 1) }}" key="t-list" style="font-size: 14px; color: #fff;">Contact Info</a></li>
                <li><a href="{{ route('general.edit', 1) }}" key="t-list" style="font-size: 14px; color: #fff;">General Setting</a></li>
                <li><a href="{{ route('social.edit', 1) }}" key="t-list" style="font-size: 14px; color: #fff;">Social Setting</a></li>
            </ul>
        </li>
        {{-- End - Website Content --}}
    </ul>
</div>

    @else

    <div id="sidebar-menu" style="background-color: #2E3B4E; border-radius: 0 10px 10px 0;">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title" key="t-menu" style="font-size: 18px; font-weight: 1000; color: #fff;">Menu</li>

            {{-- Appointments --}}
            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5733;">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-loation">Appointments</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('appointment.index') }}" key="t-create" style="font-size: 14px; color: #fff;">All Appointment</a></li>
                </ul>
            </li>
            {{-- End - Appointments --}}


            {{-- Appointments --}}
            <li>
                <a href="javascript:void(0);" class="has-arrow waves-effect" style="font-size: 15px; color: #fff; border-left: 4px solid #FF5733;">
                    <i class="bx bx-home-circle"></i>
                    <span key="t-loation">Patient Chats</span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li><a href="{{ route('get.patient.chat') }}" key="t-create" style="font-size: 14px; color: #fff;">Chats</a></li>
                </ul>
            </li>
            {{-- End - Appointments --}}

        </ul>
    </div>

@endif

