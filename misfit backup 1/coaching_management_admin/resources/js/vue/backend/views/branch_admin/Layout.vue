<template>
    <div class="st_dashboard_wrapper border-2">
        <div class="left_navbar custom_scroll" id="left_navbar_dashboard">
            <h2 class="text-center my-3">Dashboard</h2>
            <div>
                <LeftNavBar></LeftNavBar>
            </div>
        </div>
        
        <div class="st_content p-2">
            
            <div class="d-flex">
                <div class="justify-content-start">
                    <button class="btn toggle ps-0">
                        <span></span>
                        <i @click="toggle()" class="fas fa-bars fa-lg"></i>
                    </button>
                </div>
            </div>
            <router-view></router-view>
        </div>
    </div>
</template>

<script>

import { mapActions, mapGetters } from "vuex";
import LeftNavBar from './components/LeftNavBar.vue';
export default {
    components: { LeftNavBar },
    created: function () {
        this.fetch_check_auth();
        console.log(this.get_check_auth);
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
    },
    methods: {
        ...mapActions(["fetch_check_auth"]),
        toggle() {
            window.toggleSidebar()
        }
    },
    computed: {
        ...mapGetters(["get_check_auth"]),
    },
};
</script>

<style></style>
