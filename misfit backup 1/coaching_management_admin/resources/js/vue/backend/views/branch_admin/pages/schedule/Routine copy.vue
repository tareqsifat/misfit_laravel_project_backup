<template>
  <div class="conatiner">
    <div class="card list_card pb-5">
      <div class="card-header">
        <h4>Class routine</h4>
      </div>
      <div class="table-responsive card-body text-nowrap">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Class</th>
              <th>Batch</th>
              <th>Subject</th>
              <th>Schedule</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="classData in classes" :key="classData.id">
              <td>{{ classData.title }}</td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item" v-for="batch in classData.batch" :key="batch.id">
                    {{ batch.name }}
                  </li>
                </ul>
              </td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item" v-for="subject in classData.subjects" :key="subject.id">
                    {{ subject.title }}
                  </li>
                </ul>
              </td>
              <td>
                <ul class="list-group">
                  <li class="list-group-item" v-for="subject in classData.subjects" :key="subject.id">
                    <ul class="list-group">
                      <li class="list-group-item" v-for="schedule in subject.time_schedule" :key="schedule.id">
                        <b>{{ schedule.day }}</b> - {{ schedule.start_time }} to {{ schedule.end_time }} - <b>Room no</b> - {{ schedule.room }}
                      </li>
                    </ul>
                  </li>
                </ul>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from "vuex";
import PermissionButton from "../../../components/PermissionButton.vue";
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
      classes: {}
    };
  },
  created: function() {
    // this[`fetch_${store_prefix}s`]();
    this.fetch_all_routines();
  },
  watch: {
    get_all_routines: function(val) {
      if (val.length > 0) {
        this.classes = val;
      }
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
      `fetch_all_routines`
    ]),
    ...mapMutations([
      `set_${store_prefix}_paginate`,
      `set_${store_prefix}_page`,
      `set_${store_prefix}_search_key`,
      `set_${store_prefix}_orderByCol`,
      `set_${store_prefix}_show_active_data`,
      `set_${store_prefix}`,
      `set_selected_${store_prefix}s`,
      `set_select_all_${store_prefix}s`,
      `set_clear_selected_${store_prefix}s`,
      `set_${store_prefix}_show_selected`
    ]),

    calculateRowSpan(data) {
      let count = 0;
      for (const item of data) {
        count += item.subjects.length || 1;
      }
      return count;
    },
    formatTime(time) {
      return time.substring(0, 5); // Extract the time part (hh:mm) from the datetime string
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
    }
  },
  computed: {
    ...mapGetters([
      `get_${store_prefix}s`,
      `get_${store_prefix}_selected`,
      `get_${store_prefix}_show_active_data`,
      `get_all_routines`
    ])
  }
};
</script>

<style>
</style>


