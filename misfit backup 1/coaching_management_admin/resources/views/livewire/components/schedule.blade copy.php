<div>
    {{-- The Master doesn't talk, he acts. --}}
    <table class="table_area">
        <!-- table_head area start -->
        <thead>
            <tr class="table_head_area">
                <th class="head_class_title">class name</th>
                <th class="head_batch_title">batch</th>
                <th class="head_subject_title">subject</th>
                @foreach ($daysOfWeek as $day)    
                    <th class="head_day_time_room_title">
                        <span class="head_day_time_room head_day">{{ $day }}</span>
                        <span class="head_day_time_room head_time_and_room">
                            <span class="head_time">time</span>
                            <span class="head_silash">/</span>
                            <span class="head_room">room</span>

                        </span>
                    </th>
                @endforeach
                
            </tr>
        </thead>
        <!-- table_head area end -->

        <tbody>
            @foreach ($schedules as $item)    
                {{-- @dd($item['class_rowspan']) --}}
                <!-- table_body area start -->
                <tr class="table_body">
                    <td class="class" @if($item['class_rowspan']) rowspan="{{ $item['class_rowspan'] }}" @endif>{{ $item['class_name'] }}</td>
                    <td class="batch" @if($item['batch_rowspan']) rowspan="{{ $item['batch_rowspan'] }}" @endif>{{ $item['batch_name'] }}</td>
                    <td class="subject">{{ $item['subject_name'] }}</td>
                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['saturday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['saturday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['saturday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['sunday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['sunday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['sunday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['monday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['monday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['monday_room'] }}</span>
                            </span>
                        </span>
                    </td>


                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['tuesday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['tuesday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['tuesday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['wednesday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['wednesday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['wednesday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['thursday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['thursday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['thursday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                    <td class="class_time_and_room_content">
                        <span class="class_time_and_room">
                            <span class="time_rooom class_time">{{ $item['friday_time'] }}</span>
                            <span class="time_rooom class_room">
                                @if ($item['friday_time'] != '')
                                    <span class="room_title">room</span>
                                @endif
                                <span class="dash_title">-</span>
                                <span class="room_number">{{ $item['friday_room'] }}</span>
                            </span>
                        </span>
                    </td>

                </tr>
                <!-- table_body area end -->
            @endforeach
        </tbody>

    </table>
</div>
