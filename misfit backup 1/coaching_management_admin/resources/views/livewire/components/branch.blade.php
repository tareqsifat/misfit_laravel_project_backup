<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}
    <section class="courses_area" id="course_area">
        <div class="container">

            
            <!-- courses_area_title start-->
            <div class="courses_area_title">
                <h2>Our Branches</h2>
            </div>
            <!-- courses_area_title end -->
            <div class="branch_area mb-5">
                <div class="row">
                    <table class="table" id="branch_table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Branch</th>
                            <th scope="col">Branch Code</th>
                            <th scope="col">Address</th>
                            <th scope="col">Mobile Number</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $key => $item) 
                            <tr>
                                <th>{{ $key+1 }}</th>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->state }}</td>
                                <td>{{ $item->street }}</td>
                                <td>
                                    @foreach ($item->institute_branch_contact as $contact)
                                
                                    {{-- <p class="card-text"><b>Name: </b>{{ $contact->first_name }} {{ $contact->last_name }}</p> --}}
                                        <div class="js-conveyor-branch">
                                            <ul>
                                                <li>
                                                    <p><b><i class="fas fa-phone color_secondary"></i><span class="color_primary ps-1"></b> {{ $contact->phone_number }}</p></span>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                </td>
                            </tr>
                          @endforeach
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </section>
</div>
