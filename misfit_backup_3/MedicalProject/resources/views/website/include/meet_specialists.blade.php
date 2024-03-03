<div class="container clearfix">
    <div class="heading-block center border-bottom-0">
        <h3>Meet our Team of Specialists<span>.</span></h3>
        <span>We make sure that your Life are in Good Hands.</span>
    </div>

    <div id="oc-team" class="owl-carousel team-carousel carousel-widget" data-margin="30" data-nav="true" data-pagi="true" data-items-xs="1" data-items-sm="2" data-items-lg="3" data-items-xl="4">

        @foreach ($doctor as $item)
            <div class="team">
            <div class="team-image">
                <img src='{{ asset("/uploads/doctors/$item->photo") }}' alt="{{ $item->photo }}">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>{{ $item->name }}</h4><span>{{ $item->designation }}</span></div>
            </div>
        </div>
        @endforeach
        

        {{-- <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/2.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Bryan Mcguire</h4><span>Orthopedist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/3.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Mary Jane</h4><span>Neurologist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/4.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Silvia Bush</h4><span>Dentist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/6.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Hugh Baldwin</h4><span>Cardiologist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/7.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Erika Todd</h4><span>Neurologist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/8.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Randy Adams</h4><span>Dentist</span></div>
            </div>
        </div>

        <div class="team">
            <div class="team-image">
                <img src="{{ asset('contents/website') }}/demos/medical/images/doctors/9.jpg" alt="Dr. John Doe">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4>Dr. Alan Freeman</h4><span>Eye Specialist</span></div>
            </div>
        </div> --}}

    </div>

</div>