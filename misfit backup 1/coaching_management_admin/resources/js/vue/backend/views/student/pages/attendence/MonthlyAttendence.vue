<template>
    <section class="p-2">
        <div class="card list_card">
            <div class="card-header">
                <h4>Month wise attendence report</h4>
                <div class="btns">
                    <i class="fa-solid fa-square-full color-primary"></i> Present
                    <!-- <a href=""
                        @click.prevent="call_store(`set_${store_prefix}`, null), $router.push({ name: 'AllContactMessage' })"
                        class="btn rounded-pill btn-outline-warning">
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span>
                            Back
                        </span>
                    </a> -->
                </div>
            </div>
            <div class="card-body table-responsive pb-5 ">
                <div class="result_content">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="sidebar">
                            <h2>Calendar</h2>
                            <ul class="list-group">
                                <li class="list-group-item"
                                :class="{ active: selectedMonth === month.name }"
                                v-for="(month, index) in months"
                                :key="index"
                                @click="selectMonth(month)">
                                {{ month.name }}
                                </li>
                            </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="calendar">
                            <div class="calendar-header">
                                <h2>{{ selectedMonth }} {{ selectedYear }}</h2>
                                <div class="month-selector">
                                <label for="month">Select Month:</label>
                                <input class="form-control my-2" type="month" id="month" v-model="selectedMonthYear" @change="updateMonth">
                                </div>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th v-for="day in days" :key="day">{{ day }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(week, weekIndex) in calendar" :key="weekIndex">
                                    <td v-for="(day, dayIndex) in week" :key="dayIndex">
                                        <span :id="`${selectedYear}-${selectedMonthValue}-${day.toString().padStart(2, 0)}`" v-if="day !== null">{{ day }}</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
/** store and route prefix for export object use */
import { mapActions, mapGetters, mapMutations } from 'vuex';
export default {
    data: function () {
        return {
            days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            selectedMonth: '',
            selectedMonthValue: '',
            selectedYear: '',
            selectedMonthYear: '',
            calendar: [],
            months: [
            { name: 'January', value: '01' },
            { name: 'February', value: '02' },
            { name: 'March', value: '03' },
            { name: 'April', value: '04' },
            { name: 'May', value: '05' },
            { name: 'June', value: '06' },
            { name: 'July', value: '07' },
            { name: 'August', value: '08' },
            { name: 'September', value: '09' },
            { name: 'October', value: '10' },
            { name: 'November', value: '11' },
            { name: 'December', value: '12' }
            ]
        }
    },
    mounted() {
        const currentDate = new Date();
        const month = currentDate.getMonth();
        const year = currentDate.getFullYear();
        this.selectedMonth = this.months[month].name;
        this.selectedMonthValue = this.months[month].value;
        this.selectedYear = String(year);
        this.selectedMonthYear = `${year}-${this.months[month].value}`;
        this.generateCalendar();
    },
    created: function () {
        // this.fetch_single_student_attendence()
    },
    methods: {
        ...mapActions([
            `fetch_single_student_attendence`,
            `fetch_student_monthly_attendence`
        ]),
        generateCalendar() {
          const monthObj = this.months.find(month => month.name === this.selectedMonth);
          const numDaysInMonth = new Date(this.selectedYear, monthObj.value, 0).getDate();

          const firstDayOfMonth = new Date(this.selectedYear, this.getMonthIndex(this.selectedMonth), 1);
          const firstDayOfWeek = (firstDayOfMonth.getDay() + 1) % 7; // Adjusted to start with Sunday

          const prevMonthDays = (firstDayOfWeek === 0) ? 6 : firstDayOfWeek - 1;

          const totalDays = prevMonthDays + numDaysInMonth;
          const numRows = Math.ceil(totalDays / 7);

          let dayCounter = 1;
          this.calendar = [];

          for (let i = 0; i < numRows; i++) {
            let week = [];
            for (let j = 0; j < 7; j++) {
              if (i === 0 && j < prevMonthDays) {
                week.push(null);
              } else if (dayCounter > numDaysInMonth) {
                week.push(null);
              } else {
                week.push(dayCounter);
                dayCounter++;
              }
            }
            this.calendar.push(week);
          }
        },
        selectMonth(month) {
          this.selectedMonth = month.name;
          this.selectedMonthValue = month.value;
          this.selectedMonthYear = `${this.selectedYear}-${month.value}`;
          this.generateCalendar();

          let date = {
            month: month.value,
            year: this.selectedYear
          }
          this.fetch_student_monthly_attendence(date);
        //   console.log(month, this.selectedYear);
        },
        updateMonth() {
          const [selectedYear, selectedMonth] = this.selectedMonthYear.split('-');
          this.selectedYear = selectedYear;
          this.selectedMonth = this.months.find(month => month.value === selectedMonth).name;
          this.selectedMonthValue = this.months.find(month => month.value === selectedMonth).value;
          this.generateCalendar();
        },
        getMonthIndex(month) {
          return this.months.findIndex(m => m.name === month);
        }
    },
    watch: {
        selectedMonthYear() {
          this.updateMonth();
        },
        get_student_monthly_attendence: {
            handler: function (newv, oldv) {
                [...document.querySelectorAll('.active_cell')].forEach(element => {
                    element.classList.remove('active_cell');
                })
                newv.forEach(element => {
                    let date = document.getElementById(element.date);
                    date.parentNode.classList.add("active_cell");
                });
            },
            deep: true,
        }
    },
    computed: {
        ...mapGetters([
            `get_student_monthly_attendence`,
        ]),
    }
}
</script>

<style scoped>
.active {
    background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
    box-shadow: 0px 2px 6px 0px rgba(115,103,240,.48);
    color: #fff !important;
}
.active_cell {
    background: linear-gradient(72.47deg, #7367f0 22.16%, rgba(115, 103, 240, 0.7) 76.47%);
    box-shadow: 0px 2px 6px 0px rgba(115,103,240,.48);
    color: #fff !important;
}
.color-primary {
    color: #7367f0;
}
</style>
