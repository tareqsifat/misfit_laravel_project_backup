<template>
  <section class="p-5 custom_scroll" style="overflow-y: auto !important; height: calc(100vh - 100px);">
    <div class="row">
      <div class="col-xl-12 mb-4 col-lg-12 col-12">

        <div v-if="notification_status" class="alert alert-primary alert-dismissible fade show" role="alert">
          You have <strong>{{ notification_count }}</strong> new notification.
          <router-link :to="{ name: 'branch_notification' }" class="alert-link font-weight-bold"> View all notifications</router-link>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="card h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between mb-3 w-100">
              <div>
                <h5 class="card-title mb-0">Statistics</h5>
              </div>
              <!-- <small class="text-muted">Updated 1 month ago</small> -->
              <div>
                <label for="month">Filter by month</label>
                <select v-model="month" @change="filter_stats_by_month($event)" class="form-select" name="month" id="month">
                  <option v-for="(item, index) in months" :key="index" :value="index+1">{{ item }}</option>
                </select>
              </div>
            </div>
          </div>
          <div v-if="get_dashboard_stats" class="card-body">
            <div class="row gy-3">
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-primary me-3 p-2">
                    <i class="fa-solid fa-chart-pie"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_orders }}</h5>
                    <small>Total Orders</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-info me-3 p-2">
                    <i class="fa-solid fa-user-group"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_customers }}</h5>
                    <small>Customers</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-danger me-3 p-2">
                    <i class="fa-solid fa-cart-shopping"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_products }}</h5>
                    <small>Products</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="fa-solid fa-money-bills"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_income }}</h5>
                    <small>Total Income</small>
                  </div>
                </div>
              </div>

              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-primary me-3 p-2">
                    <i class="fa-solid fa-shop-lock"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_batch }}</h5>
                    <small>Batch</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-info me-3 p-2">
                    <i class="fa-solid fa-graduation-cap"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_students }}</h5>
                    <small>Total Students</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-danger me-3 p-2">
                    <i class="fa-solid fa-user-tie"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_teachers }}</h5>
                    <small>Total teachers</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="fa-solid fa-money-bills"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">{{ get_dashboard_stats.total_expense }}</h5>
                    <small>Total expense</small>
                  </div>
                </div>
              </div>

              
            </div>
          </div>
        </div>
      </div>

      <div v-if="loaded" class="col-xl-6 mb-4 col-lg-6 col-6 col-md-6">
        <div class="card h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
              <h5 class="card-title mb-0">Total monthly order value</h5>
              <!-- <small class="text-muted">Updated 1 month ago</small> -->
            </div>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <Bar :options="chartOptions" :data="chartData" />
            </div>
          </div>
        </div>
      </div>

      <div v-if="loaded" class="col-xl-6 mb-4 col-lg-6 col-6 col-md-6">
        <div class="card h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
              <h5 class="card-title mb-0">Total monthly income</h5>
              <!-- <small class="text-muted">Updated 1 month ago</small> -->
            </div>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <LineChart id="line-chart" :options="LinechartOptions" :data="LinechartData" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import { Bar, Line as LineChart } from "vue-chartjs";
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LineElement,
  LinearScale,
  PointElement
} from "chart.js";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  BarElement,
  CategoryScale,
  LineElement,
  LinearScale,
  PointElement
);

export default {
  components: { Bar, LineChart },
  data() {
    return {
      chartData: {
        labels: [
            
        ],
        datasets: [
          {
            data: [],
            backgroundColor: "#695fd7",
            label: "Monthly Orders"
          }
        ]
      },
      loaded: false,
      months: [
          "January", "February", "March", "April", "May", "June", 
          "July", "August", "September", "October", "November", "December"
      ],
      month: '',
      LinechartData: {
        labels: [
          
        ],
        datasets: [
          {
            label: "Monthly income",
            backgroundColor: "#07b8d0",
            borderColor: "#07b8d0",
            data: []
          }
        ]
      },
      LinechartOptions: {
        responsive: true,
        maintainAspectRatio: false
      },
      chartOptions: {
        responsive: true
      },
      notification_status: false,
      notification_count: 0,
    };
  },
  created: function() {
    this.fetch_branch_dashboard_stats();
    this.fetch_check_auth();
  },
  
  methods: {
    ...mapActions([
        `fetch_branch_dashboard_stats`,
        `fetch_branch_dashboard_stats_by_month`,
        `fetch_check_auth`
    ]),
    filter_stats_by_month: function(event) {
      this.fetch_branch_dashboard_stats_by_month(event);
    }
  },
  computed: {
    ...mapGetters([
      `get_dashboard_stats`,
      `get_auth_information`
    ])
  },
  watch: {
      get_dashboard_stats: {
          
          handler: function (newv, oldv) {
              this.chartData.datasets[0]['data'] = newv.order_totals;
              this.chartData.labels = newv.month_name;
              this.LinechartData.labels = newv.month_name;
              this.LinechartData.datasets[0]['data'] = newv.monthly_income;

              let that = this;
              that.loaded = true;
          },
          deep: true,
      },
      get_auth_information: {
          handler: function (newv, oldv) {
              if(newv.user_notification) {
                  var count = 0;
                  newv.user_notification.forEach(element => {
                      if(element.seen === 0) {
                          this.notification_status = true;
                          count++;
                          this.notification_count = count;
                          // console.log(count);
                      }
                  });
              }
          },
      }
  },
};
</script>

<style>
.badge {
  --bs-badge-padding-x: 1em;
  --bs-badge-padding-y: 0.49em;
  --bs-badge-font-size: 0.81em;
  --bs-badge-font-weight: 600;
  --bs-badge-color: #fff;
  --bs-badge-border-radius: 0.25rem;
  display: inline-block;
  padding: var(--bs-badge-padding-y) var(--bs-badge-padding-x);
  font-size: var(--bs-badge-font-size);
  font-weight: var(--bs-badge-font-weight);
  line-height: 1;
  color: var(--bs-badge-color);
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: var(--bs-badge-border-radius);
}

.badge:empty {
  display: none;
}

.btn .badge {
  position: relative;
  top: -1px;
}

.rounded-circle {
  border-radius: 50% !important;
}

.rounded-pill {
  border-radius: 50rem !important;
}

.rounded-top {
  border-top-left-radius: 0.375rem !important;
  border-top-right-radius: 0.375rem !important;
}

.rounded-bottom {
  border-bottom-right-radius: 0.375rem !important;
  border-bottom-left-radius: 0.375rem !important;
}
.alert-primary {
    background-color: #3a3b64;
    border-color: #3a3b64;
    color: #7367f0;
}

.alert {
    --bs-alert-bg: transparent;
    --bs-alert-padding-x: 0.875rem;
    --bs-alert-padding-y: 0.687rem;
    --bs-alert-margin-bottom: 1rem;
    --bs-alert-color: inherit;
    --bs-alert-border-color: transparent;
    --bs-alert-border: 1px solid var(--bs-alert-border-color);
    --bs-alert-border-radius: 0.375rem;
    position: relative;
    padding: var(--bs-alert-padding-y) var(--bs-alert-padding-x);
    margin-bottom: var(--bs-alert-margin-bottom);
    color: var(--bs-alert-color);
    background-color: var(--bs-alert-bg);
    border: var(--bs-alert-border);
    border-radius: var(--bs-alert-border-radius);
}
.alert-dismissible {
    padding-right: 2.625rem;
}
.row-bordered.row-border-light > .col::before,
.row-bordered.row-border-light > .col::after,
.row-bordered.row-border-light > [class^="col-"]::before,
.row-bordered.row-border-light > [class^="col-"]::after,
.row-bordered.row-border-light > [class*=" col-"]::before,
.row-bordered.row-border-light > [class*=" col-"]::after,
.row-bordered.row-border-light > [class^="col "]::before,
.row-bordered.row-border-light > [class^="col "]::after,
.row-bordered.row-border-light > [class*=" col "]::before,
.row-bordered.row-border-light > [class*=" col "]::after,
.row-bordered.row-border-light > [class$=" col"]::before,
.row-bordered.row-border-light > [class$=" col"]::after,
.row-bordered.row-border-light > [class="col"]::before,
.row-bordered.row-border-light > [class="col"]::after {
  border-color: rgba(255, 255, 255, 0.8);
}

[dir="rtl"] .row-bordered > .col::after,
[dir="rtl"] .row-bordered > [class^="col-"]::after,
[dir="rtl"] .row-bordered > [class*=" col-"]::after,
[dir="rtl"] .row-bordered > [class^="col "]::after,
[dir="rtl"] .row-bordered > [class*=" col "]::after,
[dir="rtl"] .row-bordered > [class$=" col"]::after,
[dir="rtl"] .row-bordered > [class="col"]::after {
  left: auto;
  right: -1px;
}

.bg-label-secondary {
  background-color: #424659 !important;
  color: #a8aaae !important;
}

.bg-label-success {
  background-color: #2e4b4f !important;
  color: #28c76f !important;
}

.bg-label-info {
  background-color: #274c62 !important;
  color: #00cfe8 !important;
}

.bg-label-warning {
  background-color: #504448 !important;
  color: #ff9f43 !important;
}

.bg-label-danger {
  background-color: #4d384b !important;
  color: #ea5455 !important;
}

.bg-label-light {
  background-color: #32364c !important;
  color: #44475b !important;
}

.bg-label-dark {
  background-color: #4a4d61 !important;
  color: #d7d8de !important;
}

.bg-label-gray {
  background-color: rgba(70, 74, 94, 0.968) !important;
  color: rgba(255, 255, 255, 0.8) !important;
}

.bg-dark {
  color: #fff;
  background-color: #44475b !important;
}

.bg-label-dark {
  background-color: #32364c !important;
  color: #44475b !important;
}

a.bg-dark:hover,
a.bg-dark:focus {
  background-color: rgba(0, 0, 0, 0.65) !important;
}

a.bg-light:hover,
a.bg-light:focus {
  background-color: rgba(255, 255, 255, 0.6) !important;
}

a.bg-lighter:hover,
a.bg-lighter:focus {
  background-color: rgba(255, 255, 255, 0.8) !important;
}

a.bg-lightest:hover,
a.bg-lightest:focus {
  background-color: rgba(255, 255, 255, 0.03) !important;
}
.bg-label-primary {
  background-color: #3a3b64 !important;
  color: #7367f0 !important;
}
</style>
