<template>
    <section class="p-5">
        <div class="row">
            <div class="col-xl-12 mb-4 col-lg-12 col-12">
                <div v-if="notification_status" class="alert alert-primary alert-dismissible fade show" role="alert">
                    You have <strong>{{ notification_count }}</strong> new notification.
                    <router-link :to="{ name: 'student_notification' }" class="alert-link font-weight-bold"> View all notifications</router-link>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="card p-2 mb-4">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">Monthly report</h5>
                            <!-- <small class="text-muted">Updated 1 month ago</small> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="fa-sharp fa-solid fa-calendar-days"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ get_dashboard_stats.total_attendences }}</h5>
                                        <small>Total Attendence</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="fa-solid fa-user-group"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ get_dashboard_stats.total_batch }}</h5>
                                        <small>Total Batch</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="fa-solid fa-list-check"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ get_dashboard_stats.total_exam }}</h5>
                                        <small>Total Exam</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="d-flex align-items-center">
                                    <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="fa-solid fa-list-ol"></i></div>
                                    <div class="card-info">
                                        <h5 class="mb-0">{{ get_dashboard_stats.avg_mark }}</h5>
                                        <small>Average Mark</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-2">
                    <div class="card-header">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="card-title mb-0">News & Notices</h5>
                            <!-- <small class="text-muted">Updated 1 month ago</small> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <!-- User List Style -->
                            <div class="col-12 col-lg-6 mb-4 mb-xl-0">
                                <h6 class="text-light fw-medium">News & events</h6>
                                <div class="list-group custom_scroll" style="height: 430px; overflow-y: scroll;">
                                    <div v-for="(news, index) in get_dashboard_stats.news" :key="index" class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                        <img :src="news.image" width="80" height="80" alt="User Image" class="rounded-circle me-3 w-px-50" />
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <div class="user-info">
                                                    <h6 class="mb-1">{{ news.title }}</h6>
                                                    <small>{{ new Date(news.created_at).toDateString()  }}</small>
                                                   
                                                </div>
                                                <div class="add-btn">
                                                    <router-link class="btn btn-primary btn-sm waves-effect waves-light" :to="{name:`DetailsStudentNewsEvent`,params:{id: news.id}}">
                                                        Details
                                                    </router-link>
                                                    <!-- <button class="btn btn-primary btn-sm waves-effect waves-light"></button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <router-link :to="{name:`AllStudentNewsEvent`}" class="btn btn-primary btn-sm waves-effect waves-light">View All</router-link>
                                </div>
                            </div>

                            <div class="col-12 col-lg-6 mb-4 mb-xl-0">
                                <h6 class="text-light fw-medium">Notice</h6>
                                <div class="list-group custom_scroll" style="height: 430px; overflow-y: scroll;">
                                    <div v-for="(news, index) in get_dashboard_stats.news" :key="index" class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                        <!-- <img :src="news.image" width="80" height="80" alt="User Image" class="rounded-circle me-3 w-px-50" /> -->
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between">
                                                <div class="user-info">
                                                    <h6 class="mb-1">{{ news.title }}</h6>
                                                    <small>{{ new Date(news.created_at).toDateString()  }}</small>
                                                   
                                                </div>
                                                <div class="add-btn">
                                                    <!-- <button class="btn btn-primary btn-sm waves-effect waves-light">Details</button> -->
                                                    <router-link class="btn btn-primary btn-sm waves-effect waves-light" :to="{name:`DetailsStudentNotice`,params:{id: news.id}}">
                                                        Details
                                                    </router-link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mt-3">
                                    <router-link :to="{name:`AllStudentNotice`}" class="btn btn-primary btn-sm waves-effect waves-light">View All</router-link>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  data() {
    return {
      notification_status: false,
      notification_count: 0
    }
  },
  created: function() {
    this.fetch_student_dashboard_stats();
    this.fetch_check_auth();
  },
  
  methods: {
    ...mapActions([
        `fetch_student_dashboard_stats`,
        `fetch_check_auth`
    ]),
  },
  computed: {
    ...mapGetters([
      `get_dashboard_stats`,
      `get_auth_information`
    ])
  },
  watch: {
    //   get_dashboard_stats: {
          
    //       handler: function (newv, oldv) {
    //           this.chartData.datasets[0]['data'] = newv.order_totals;
    //           this.chartData.labels = newv.month_name;
    //           this.LinechartData.labels = newv.month_name;
    //           this.LinechartData.datasets[0]['data'] = newv.monthly_income;

    //           let that = this;
    //           that.loaded = true;
    //       },
    //       deep: true,
    //   },
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
}
</script>

<style scoped>
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
    border-radius: var(--bs-badge-border-radius)
}

.badge:empty {
    display: none
}

.btn .badge {
    position: relative;
    top: -1px
}

.rounded-circle {
    border-radius: 50% !important
}

.rounded-pill {
    border-radius: 50rem !important
}

.rounded-top {
    border-top-left-radius: .375rem !important;
    border-top-right-radius: .375rem !important
}

.rounded-bottom {
    border-bottom-right-radius: .375rem !important;
    border-bottom-left-radius: .375rem !important
}

.row-bordered.row-border-light>.col::before,.row-bordered.row-border-light>.col::after,.row-bordered.row-border-light>[class^=col-]::before,.row-bordered.row-border-light>[class^=col-]::after,.row-bordered.row-border-light>[class*=" col-"]::before,.row-bordered.row-border-light>[class*=" col-"]::after,.row-bordered.row-border-light>[class^="col "]::before,.row-bordered.row-border-light>[class^="col "]::after,.row-bordered.row-border-light>[class*=" col "]::before,.row-bordered.row-border-light>[class*=" col "]::after,.row-bordered.row-border-light>[class$=" col"]::before,.row-bordered.row-border-light>[class$=" col"]::after,.row-bordered.row-border-light>[class=col]::before,.row-bordered.row-border-light>[class=col]::after {
    border-color: rgba(255,255,255,.8)
}

[dir=rtl] .row-bordered>.col::after,[dir=rtl] .row-bordered>[class^=col-]::after,[dir=rtl] .row-bordered>[class*=" col-"]::after,[dir=rtl] .row-bordered>[class^="col "]::after,[dir=rtl] .row-bordered>[class*=" col "]::after,[dir=rtl] .row-bordered>[class$=" col"]::after,[dir=rtl] .row-bordered>[class=col]::after {
    left: auto;
    right: -1px
}

.bg-label-secondary {
    background-color: #424659 !important;
    color: #a8aaae !important
}

.bg-label-success {
    background-color: #2e4b4f !important;
    color: #28c76f !important
}

.bg-label-info {
    background-color: #274c62 !important;
    color: #00cfe8 !important
}

.bg-label-warning {
    background-color: #504448 !important;
    color: #ff9f43 !important
}

.bg-label-danger {
    background-color: #4d384b !important;
    color: #ea5455 !important
}

.bg-label-light {
    background-color: #32364c !important;
    color: #44475b !important
}

.bg-label-dark {
    background-color: #4a4d61 !important;
    color: #d7d8de !important
}

.bg-label-gray {
    background-color: rgba(70,74,94,.968) !important;
    color: rgba(255,255,255,.8) !important
}

.bg-dark {
    color: #fff;
    background-color: #44475b !important
}

.bg-label-dark {
    background-color: #32364c !important;
    color: #44475b !important
}

a.bg-dark:hover,a.bg-dark:focus {
    background-color: rgba(0,0,0,.65) !important
}

a.bg-light:hover,a.bg-light:focus {
    background-color: rgba(255,255,255,.6) !important
}

a.bg-lighter:hover,a.bg-lighter:focus {
    background-color: rgba(255,255,255,.8) !important
}

a.bg-lightest:hover,a.bg-lightest:focus {
    background-color: rgba(255,255,255,.03) !important
}
.bg-label-primary {
    background-color: #3a3b64 !important;
    color: #7367f0 !important
}

</style>
