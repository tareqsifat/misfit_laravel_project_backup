<template>
    <div v-if="get_check_auth">
        <top-nav></top-nav>
        <main-menu></main-menu>
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper container-xxl p-0">
                <!-- <bread-cumb></bread-cumb> -->
                <div class="content-body">
                    <router-view></router-view>
                </div>
            </div>
        </div>
        <!-- END: Content-->
        <div class="loader export_loader">
            <div class="loader_body">
                <div class="progress"></div>
                <div class="load_amount">
                    <h4>0</h4>
                    <h5>%</h5>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import BreadCumb from "./layouts/main_body/BreadCumb.vue";
import MainMenu from "./layouts/main_menu/MainMenu.vue";
import TopNav from "./layouts/TopNav.vue";
import { mapActions, mapGetters } from "vuex";
export default {
    data: function(){
        return {
            notification_status: false,
            notification_count: 0
        }
    },
    components: { TopNav, MainMenu, BreadCumb },
    created: function () {
        this.fetch_check_auth();
        // this.fetch_site_settings();
    },
    watch: {
        get_check_auth: {
            handler: function (newv, oldv) {
                // console.log(newv);
                // setTimeout(() => {
                // $('.navigation li a.active').parents('li.has-sub').addClass('open');
                // }, 500);
                if (!newv) {
                    localStorage.removeItem("token");
                    location.href = "/login";
                }
            },
            deep: true,
        },
        get_auth_information: {
            handler: function (newv, oldv) {
                
                newv.roles.forEach(element => {
                    if(element.name == "Student") {
                        this.$router.push({path: '/student'})
                    }
                    if(element.name == "Teacher") {
                        this.$router.push({path: '/teacher'})
                    }
                    if(element.name == "branch_admin") {
                        this.$router.push({path: '/branch-admin'})
                    }
                });

                if(newv.user_notification.length > 0) {
                    this.notification_status = true;
                    this.notification_count = newv.user_notification.length;
                }
            },
        }
    },
    methods: {
        ...mapActions([
            "fetch_check_auth"
        ]),
    },
    computed: {
        ...mapGetters([
            "get_check_auth",
            "get_auth_information"
        ]),
    },
};
</script>

<style>
</style>
