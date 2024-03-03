<div>
    @if (count($schedules) > 1)
    <table class="table table-bordered table_area">
        <thead>
            <tr class="table_head_area">
                <th class="head_class_title">Class Name</th>
                <th class="head_batch_title">Batch</th>
                <th class="head_subject_title">Subject</th>
                @foreach($daysOfWeek as $day)
                    <th class="head_day_time_room_title">
                        <span class="head_day_time_room head_day">{{ $day }}</span>
                        <span class="head_day_time_room head_time_and_room">
                            <span class="head_time">Time</span>
                            <span class="head_silash">/</span>
                            <span class="head_room">Room</span>
                        </span>
                    </th>
                @endforeach
            </tr>
        </thead>
        <!-- table_head area end -->
    
        <tbody>
            <!-- table_body area start -->
            @foreach($schedules as $index => $classItem)
                
                <tr class="table_body">
                    @if ($classItem['class_rowspan'])
                        <td class="class" rowspan="{{ $classItem['class_rowspan'] }}">{{ $classItem['class_name'] }}</td>
                    @endif

                    @if ($classItem['batch_rowspan'])
                        <td class="batch" rowspan="{{ $classItem['batch_rowspan'] }}">{{ $classItem['batch_name_only'] }}</td>
                    @endif

                    
                    <td class="subject">{{ $classItem['subject_name'] }}</td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['saturday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['saturday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['saturday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['sunday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['sunday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['sunday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['monday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['monday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['monday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['tuesday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['tuesday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['tuesday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['wednesday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['wednesday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['wednesday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['thursday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['thursday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['thursday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $classItem['friday_time'] }}</span>
                            <span class="time_rooom class_room">
                                <span class="room_title" @if($classItem['friday_time'] != '') room @endif></span>
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $classItem['friday_room'] }}</span>
                            </span>
                        </span>
                    </td>
                    <!-- Repeat the above structure for other days -->
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <h3 class="mt-3 text-center">No routine found!</h3>
    @endif
    {{-- The Master doesn't talk, he acts. --}}
    
    
</div>
