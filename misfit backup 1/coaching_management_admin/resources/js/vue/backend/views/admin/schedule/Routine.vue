<template>
  <div class="conatiner">
    <div class="card list_card pb-5">
      <div class="card-header">
        <h4>Class routine</h4>
      </div>
      <div class="table-responsive card-body text-nowrap">
        <div class="row">
          <div class="col-6">
            <h5>select branch</h5>
            <select name="branch_id" class="form-select" v-model="branch_id" @change="call_routine_by_branch($event)" id="branch_id">
              <option >Select Branch</option>
              <option v-for="(branch, index) in get_all_branches" :key="index" :value="branch.id">{{ branch.name }}</option>
            </select>
          </div>
          <div class="col-6">
            <h5>Date wise filter</h5>
            <input type="date" @change="filter_branch_routine_by_date($event)" class="form-control">
          </div>
        </div>
        <table class="table table-bordered table_area mb-2 mt-1" v-if="show_routine == 1">
          <thead>
              <tr class="table_head_area">
                <th class="head_class_title">Class Name</th>
                <th class="head_batch_title">Batch</th>
                <th class="head_subject_title">Subject</th>
                <th v-for="day in daysOfWeek" :key="day" class="head_day_time_room_title">
                  <span class="head_day_time_room head_day">{{ day }}</span>
                  <span class="head_day_time_room head_time_and_room">
                    <span class="head_time">Time</span>
                    <span class="head_silash">/</span>
                    <span class="head_room">Room</span>
                  </span>
                </th>
              </tr>
          </thead>
          <!-- table_head area end -->

          <tbody>
              <!-- table_body area start -->
              <template v-for="(classItem, index) in custom_routine">
                
              <tr class="table_body" :key="index">
                  <td class="class" v-if="classItem.class_rowspan" :rowspan="classItem.class_rowspan">{{ classItem.class_name }}</td>
                  <td class="batch" v-if="classItem.batch_rowspan" :rowspan="classItem.batch_rowspan">{{ classItem.batch_name_only }}</td>
                  <td class="subject">{{ classItem.subject_name }}</td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.saturday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.saturday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.saturday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.sunday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.sunday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.sunday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.monday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.monday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.monday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.tuesday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.tuesday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.tuesday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.wednesday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.wednesday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.wednesday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.thursday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.thursday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.thursday_room }}</span>
                          </span>
                      </span>
                  </td>
                  <td class="class_time_and_room_content">
                      <span class="class_time_and_room">
                          <span class="time_rooom class_time">{{ classItem.friday_time }}</span>
                          <span class="time_rooom class_room">
                              <span class="room_title" v-if="classItem.friday_time != ''">room</span>
                              <span class="dash_title">-</span>
                              <span class="room_number">{{ classItem.friday_room }}</span>
                          </span>
                      </span>
                  </td>
              </tr>
              </template>
          </tbody>
        </table>

        <table class="table table-bordered table_area mb-2 mt-1" v-else>
          <thead>
              <tr class="table_head_area">
                <th class="head_class_title">Day</th>
                <th class="head_batch_title">Teacher</th>
                <th class="head_subject_title">Batch</th>
                <th class="head_subject_title">Class</th>
                <th class="head_subject_title">Subject</th>
                <th class="head_subject_title">Start time</th>
                <th class="head_subject_title">End time</th>
                <th class="head_subject_title">Room</th>
                
              </tr>
          </thead>
          <!-- table_head area end -->

          <tbody>
              <!-- table_body area start -->
              <tr class="table_body" v-for="item in get_all_routines_by_date" :key="item.id">
                <td>{{ item.day }}</td>
                <td v-if="item.teacher">{{ item.teacher.user.first_name }} {{ item.teacher.user.last_name }}</td>
                <td v-else><span class="text-danger">Teacher not added</span></td>
                <td v-if="item.batch">{{ item.batch.name }}</td>
                <td v-if="item.class">{{ item.class.title }}</td>
                <td v-if="item.subject">{{ item.subject.title }}</td>
                <td>{{ item.start_time }}</td>
                <td>{{ item.end_time }}</td>
                <td>{{ item.room }}</td>
              </tr>
              
          </tbody>
        </table>

      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import PermissionButton from "../../components/PermissionButton.vue";
import TableTh from "./components/TableTh.vue";

/** store and route prefix for export object use */
import PageSetup from "./PageSetup";
const { route_prefix, store_prefix } = PageSetup;

export default {
  components: { PermissionButton, TableTh },
  data: function() {
    return {
      store_prefix,
      route_prefix,
      daysOfWeek: [
        "saturday",
        "sunday",
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday"
      ],
      custom_routine: [],
      branch_id: null,
      show_routine: 1
    };
  },
  created: function() {
    // this[`fetch_${store_prefix}s`]();
    this.fetch_all_branches();
    // this.fetch_all_routines();
  },
  watch: {
    get_all_routines: function(val) {
      let that = this;
      this.custom_routine = val.filter(function (item) {
        if(that.check_null(item)) {
          return item;
        }
      })
    }
  },
  
  methods: {
    ...mapActions([
      `fetch_${store_prefix}s`,
      `soft_delete_${store_prefix}`,
      `restore_${store_prefix}`,
      `export_${store_prefix}_all`,
      `export_selected_${store_prefix}_csv`,
      `delete_${store_prefix}`,
      `fetch_routines_by_batch`,
      `fetch_all_branches`,
      `filter_routines_by_date`
    ]),
    hasSchedule(subject, day) {
      return subject.hasOwnProperty(day);
    },
    call_store: function(name, params = null) {
      this[name](params);
    },
    handle_pagination: function(page = 1) {
      return this[`set_${store_prefix}_page`](page);
    },
    
    check_if_data_is_selected: function(user) {
      let check_index = this[`get_${store_prefix}_selected`].findIndex(
        i => i.id == user.id
      );
      if (check_index >= 0) {
        return true;
      } else {
        return false;
      }
    },
    check_null(item) {
      if(item.saturday_time || item.sunday_time || item.monday_time || item.tuesday_time || item.wednesday_time || item.thursday_time || item.friday_time) {
        return true;
      }
      return false;
    },
    call_routine_by_branch(event) {
      this.branch_id = event.target.value;

      let data = {
        branch_id: this.branch_id,
        date: null
      }
      this.fetch_routines_by_batch(data);
    },
    filter_branch_routine_by_date: function(event) {
      this.show_routine = 0;
      if(this.branch_id == null) {
        window.s_alert("Warning: select branch first", `warning`);
      }else {
        let data = {
          branch_id: this.branch_id,
          date: event.target.value
        }
        this.filter_routines_by_date(data);
      }
    }
  },
  computed: {
    ...mapGetters([
      `get_${store_prefix}s`,
      `get_${store_prefix}_selected`,
      `get_${store_prefix}_show_active_data`,
      `get_all_routines`,
      `get_all_branches`,
      `get_all_routines_by_date`
    ])
  }
};
</script>

<style>
</style>


