<template>


<div class="container">

    <!-- Header -->
    <div class="row">
        <div class="col-12" v-if="this[`get_${store_prefix}`]">
            <div class="card mb-4">
                <!-- <div class="user-profile-header-banner">
                    <img :src="banner_img" alt="Banner image" class="rounded-top banner_img" />
                </div> -->
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4" v-if="this[`get_${store_prefix}`].student">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img :src="this[`get_${store_prefix}`].student.user.photo" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                            <div class="user-profile-info">
                                <h4>{{ this[`get_${store_prefix}`].student.user.first_name }} {{ this[`get_${store_prefix}`].student.user.last_name }}</h4>
                                <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                    <li class="list-inline-item"><i class="ti ti-color-swatch"></i> {{ this[`get_${store_prefix}`].student.user.user_name }}</li>
                                    <!-- <li class="list-inline-item"><i class="ti ti-map-pin"></i> Vatican City</li> -->
                                    <li class="list-inline-item" v-if="this[`get_${store_prefix}`].student.user"><i class="ti ti-calendar"></i> 
                                        {{ new Date(this[`get_${store_prefix}`].student.admission_date).toDateString()  }}
                                    </li>
                                </ul>
                            </div>
                            <router-link :to="{name:`IdCardBranchStudent`,params:{id: this[`get_${store_prefix}`].student.id}}" class="btn btn-primary waves-effect waves-light">
                                <!-- <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  > -->
                                    <i class="fa-solid fa-address-card me-1"></i>
                                    <span >
                                        Id card
                                    </span>
                                <!-- </a> -->
                            </router-link>
                            <!-- <a href="javascript:void(0)" class="btn btn-primary waves-effect waves-light"> <i class="fa-solid fa-address-card me-1"></i>Id card</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Header -->

    <!-- Navbar pills -->
    <!-- <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-user-check me-1"></i> Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-teams.html"><i class="ti-xs ti ti-users me-1"></i> Teams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-projects.html"><i class="ti-xs ti ti-layout-grid me-1"></i> Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pages-profile-connections.html"><i class="ti-xs ti ti-link me-1"></i> Connections</a>
                </li>
            </ul>
        </div>
    </div> -->
    <!--/ Navbar pills -->

    <!-- User Profile Content -->
    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5">
            <!-- About User -->
            <div class="card mb-4">
                <div class="card-body">
                    <small class="card-text text-uppercase">About</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> <span>{{ this[`get_${store_prefix}`].student.user.first_name }} {{ this[`get_${store_prefix}`].student.user.last_name }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-user"></i><span class="fw-bold mx-2">Branch Code:</span> <span>{{ this[`get_${store_prefix}`].student.user.branch_code }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span v-if="this[`get_${store_prefix}`].student.user.status == 1">Active</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-crown"></i><span class="fw-bold mx-2">Role:</span> <span>{{ get_auth_information.status }}</span></li> -->
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-flag"></i><span class="fw-bold mx-2">Branch:</span> <span>{{ this[`get_${store_prefix}`].student.user.branch_user[0].name }}</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-file-description"></i><span class="fw-bold mx-2">Languages:</span> <span>English</span></li> -->
                    </ul>
                    <small class="card-text text-uppercase">Contacts</small>
                    <ul class="list-unstyled mb-4 mt-3">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span> <span>{{ this[`get_${store_prefix}`].student.user.mobile_number }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-brand-skype"></i><span class="fw-bold mx-2">Telegram Id:</span> <span>{{ this[`get_${store_prefix}`].student.user.telegram_id }}</span></li>
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span> <span>{{ this[`get_${store_prefix}`].student.user.email }}</span></li>
                    </ul>
                </div>
            </div>
            <!--/ About User -->
            <!-- Profile Overview -->
            <div class="card mb-4">
                <div class="card-body">
                    <p class="card-text text-uppercase">Overview</p>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-3"><i class="ti ti-check"></i><span class="fw-bold mx-2">Total Branch:</span> <span>{{ this[`get_${store_prefix}`].student.user.branch_user.length }}</span></li>
                        <!-- <li class="d-flex align-items-center mb-3"><i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Projects Compiled:</span> <span>146</span></li>
                        <li class="d-flex align-items-center"><i class="ti ti-users"></i><span class="fw-bold mx-2">Connections:</span> <span>897</span></li> -->
                    </ul>
                </div>
            </div>
            <!--/ Profile Overview -->
        </div>
        <div class="col-xl-8 col-lg-7 col-md-7">
            <!-- Projects table -->
            <div class="card mb-4">
                <div class="card-header">
                    <h4>Stats</h4>
                    <div class="btns">
                        <!-- <a href="" @click.prevent="$router.push({ name: `AttendenceBranchStudent`, params:{id: this[`get_${store_prefix}`].student.user.id}} )"  class="btn rounded-pill btn-outline-info me-2">
                            <i class="fa-solid fa-calendar-days me-2px"></i>
                            <span >
                                Show Attendence
                            </span>
                        </a> -->
                        <router-link :to="{name:`AttendenceBranchStudent`,params:{id: this[`get_${store_prefix}`].student.user.id}}" class="btn rounded-pill btn-outline-info me-2">
                            <!-- <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  > -->
                                <i class="fa-solid fa-list-check me-5px"></i>
                                <span >
                                    Show Attendence
                                </span>
                            <!-- </a> -->
                        </router-link>
                        <router-link :to="{name:`ResultBranchStudent`,params:{id: this[`get_${store_prefix}`].student.user.id}}" class="btn rounded-pill btn-outline-primary me-2">
                            <!-- <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  > -->
                                <i class="fa-solid fa-list-check me-5px"></i>
                                <span >
                                    Show Result
                                </span>
                            <!-- </a> -->
                        </router-link>
                        <a href="" @click.prevent="call_store(`set_${store_prefix}`,null), $router.push({ name: `All${route_prefix}` })"  class="btn rounded-pill btn-outline-warning" >
                            <i class="fa fa-arrow-left me-5px"></i>
                            <span >
                                Back
                            </span>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3 mt-3">
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-2"><i class="fa-sharp fa-solid fa-calendar-days"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ this[`get_${store_prefix}`].stats.total_attendences }}</h5>
                                    <small>Total Attendence</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-2"><i class="fa-solid fa-user-group"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ this[`get_${store_prefix}`].stats.total_batch }}</h5>
                                    <small>Total Batch</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-2"><i class="fa-solid fa-list-check"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ this[`get_${store_prefix}`].stats.total_exam }}</h5>
                                    <small>Total Exam</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-2"><i class="fa-solid fa-list-ol"></i></div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ this[`get_${store_prefix}`].stats.avg_mark ? this[`get_${store_prefix}`].stats.avg_mark : 0 }}</h5>
                                    <small>Average Mark</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <div class="card custom_scroll mb-4">
                <div class="card-header">
                    <h4>Student Payments</h4>
                </div>
                <div class="card-bod">
                    <div class="table-responsive card-body text-nowrap">
                        <table v-if="this[`get_${store_prefix}`].student.payments.length" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>amount</th>
                                    <th>date</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr v-for="(asset, index) in this[`get_${store_prefix}`].student.payments" :key="index">
                                    <td><strong style="color: #7367f0;">#{{ index+1 }}</strong></td>
                                    <td v-if="student_details.student.user">
                                        <span class="fw-semibold">{{ student_details.student.user.first_name }} {{ student_details.student.user.last_name }}</span>
                                    </td>
                                    <td>{{ asset.amount }}</td>
                                    <td>{{ asset.date }}</td>
                                    <td>
                                        <ul class="d-flex gap-1 p-0" style="list-style-type:none">
                                            <router-link :to="{name:`DetailsBranchMonthlyFee`,params:{id:asset.id}}">
                                                <a class="btn btn-sm btn-outline-warning" href="javascript:void(0);"><i class="fa-solid fa-eye me-1"></i> Details</a>
                                            </router-link>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <h4 v-else class="text-center my-3">No Payment found</h4> 
                    </div>
                </div>
            </div>

            <!--/ Projects table -->
        </div>
    </div>
    <!--/ User Profile Content -->
</div>

</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import PermissionButton from '../../../components/PermissionButton.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton },
    data: function(){
        return {
            /** store prefix for JSX */
            banner_img: '/backend/app-assets/profile_banner.jpg',
            store_prefix,
            route_prefix,
            student_details: ''
        }
    },
    watch : {
        [`get_student`]: function(val) {
            if(val) {
                this.student_details = val;
            }
        },
    },
    created: function () {
        this[`fetch_${store_prefix}`]({id: this.$route.params.id, select_all:1})
    },
    methods: {
        ...mapActions([
            `fetch_${store_prefix}`,
        ]),
        ...mapMutations([
            `set_${store_prefix}`
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([`get_${store_prefix}`])
    }
}
</script>

<style>

</style>
