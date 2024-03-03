<div>
    {{-- The best athlete wants his opponent at his best. --}}
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
                @endforeach
                <!-- teacher start -->
                

               

            </div>
            <!-- teacher_area_content end -->
        </div>
    </section>
    <section class="pegination_area">
        <div class="container">
            <div class="pegination_content">
                {{-- <ul>
                    <li>
                        <a class="previous_next" href="#">previous</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">1</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">2</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">3</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">4</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">5</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">6</a>
                    </li>
                    <li>
                        <a class="pegination_number" href="#">7</a>
                    </li>

                    <li>
                        <a class="previous_next" href="#">next</a>
                    </li>
                </ul> --}}
                {{ $teachers->links() }}
            </div>
        </div>
        
        {{-- <div class="pagination">
            
        </div> --}}
    </section>
    
</div>
