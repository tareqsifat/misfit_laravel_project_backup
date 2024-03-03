<template>
    <section class="p-2">
        <div class="card list_card">
            <div class="card-header">
                <h4>Exam routine</h4>
                <div class="btns">
                    <a href=""
                        @click.prevent="call_store(`set_${store_prefix}`, null), $router.push({ name: 'AllContactMessage' })"
                        class="btn rounded-pill btn-outline-warning">
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span>
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive pb-5 ">
                <div class="class_schedule_content">
                    <!-- table_area start -->
                    <table class="table_area table-bordered">
                        <!-- table_head area start -->
                        <thead>
                            <tr class="table_head_area">
                                <th class="head_class_title">class name</th>
                                <th class="head_batch_title">batch</th>
                                <th class="head_subject_title">subject</th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">saturday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">sunday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">monday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">tuesday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">wednesday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">thursday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                                <th class="head_day_time_room_title">
                                    <span class="head_day_time_room head_day">friday</span>
                                    <span class="head_day_time_room head_time_and_room">
                                        <span class="head_time">time</span>
                                        <span class="head_silash">/</span>
                                        <span class="head_room">room</span>

                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <!-- table_head area end -->

                        <tbody>
                            <!-- table_body area start -->
                            <tr class="table_body">
                                <td class="class" rowspan="4">9</td>
                                <td class="batch" rowspan="2">science 1</td>
                                <td class="subject">bangla</td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>


                            </tr>
                            <!-- table_body area end -->
                            <!-- table_body area start -->
                            <tr class="table_body">
                                <td class="subject">english</td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>


                            </tr>
                            <!-- table_body area end -->
                            <!-- table_body area start -->
                            <tr class="table_body">
                                <td class="batch" rowspan="2">science 2</td>
                                <td class="subject">math</td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>


                            </tr>
                            <!-- table_body area end -->
                            <!-- table_body area start -->
                            <tr class="table_body">
                                <td class="subject">physics</td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                                <td class="class_time_and_room_content">
                                    <span class="class_time_and_room">
                                        <span class="time_rooom class_time">7:00 am - 8:00 am</span>
                                        <span class="time_rooom class_room">
                                            <span class="room_title">room</span>
                                            <span class="dash_title">-</span>
                                            <span class="room_number">101</span>
                                        </span>
                                    </span>
                                </td>
                            </tr>
                            <!-- table_body area end -->
                        </tbody>

                    </table>
                    <!-- table_area end -->
                </div>
            </div>

        </div>
    </section>
</template>

<script>
/** store and route prefix for export object use */

export default {
    data: function () {
        return {

        }
    },
    created: function () {
    },
    methods: {

    },
    computed: {
    }
}
</script>

<style></style>
