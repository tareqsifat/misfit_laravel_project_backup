<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <section class="teacher_area">
        <div class="container">
            <!-- teacher_area_title start -->
            <div class="teacher_area_title">
                <h2>our Lecturers</h2>
            </div>
            <!-- teacher_area_title end -->
            <!-- teacher_area_content start -->
            <div class="teacher_area_content">
                @foreach ($teachers as $item)     
                    <!-- teacher start -->
                    <div class="teacher">
                        <a href="#" class="teacher_img">
                            <img src="/{{ $item->user->photo }}" alt="teacher_img">
                        </a>
                        <div class="teacher_discription">
                            <div class="teacher_name">
                                <a href="#">{{ $item->user->first_name }} {{ $item->user->last_name }}</a>
                            </div>
                            <div class="teacher_detail_section my-1 mt-2">
                                <b>Designation: </b>{{ $item->user->designation }}
                            </div>
                            
                            <div class="teacher_detail_section mb-3">
                                <p><b>Branch: </b>{{ $item->user->branch_user[0]->name }}</p> 
                                <p><b>Education: </b>{{ $item->education }}</p>
                            </div>
                            <div class="teacher_contact">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa-regular fa-envelope"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- teacher end -->
                @endforeach
            </div>
            <!-- teacher_area_content end -->
        </div>
    </section>
</div>
