<template>
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'teacher_dashboard' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-sharp fa-solid fa-house"></i></span>
                <span class="menu-title text-truncate">Dashboard</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'class_schedule' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-sharp fa-solid fa-calendar-days"></i></span>
                <span class="menu-title text-truncate">class routine</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'Exams' }" href="#">
                <span class="icon"><i class="fa-solid fa-list-check"></i></span>
                <span class="menu-title text-truncate">Exams</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'TeacherAttendence' }" href="#">
                <span class="icon"><i class="fa-solid fa-user-clock"></i></span>
                <span class="menu-title text-truncate">Attendence</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllTeacherStudentAttendence' }" href="#">
                <span class="icon"><i class="fa-solid fa-user-clock"></i></span>
                <span class="menu-title text-truncate">Student Attendence</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'SalaryStatement' }" href="#">
                <span class="icon"><i class="fa-solid fa-money-bills"></i></span>
                <span class="menu-title text-truncate">Salary statement</span>
            </router-link>
        </li>
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'teacher_notification' }" href="#">
                <i class="fa-solid fa-bell"></i>
                <span class="menu-title text-truncate">Notifications</span>
            </router-link>
        </li>
        <li class="nav-item">
            <a @click.prevent="fetch_logout()" href="#">
                <span class="icon"><i class="fa-solid fa-power-off"></i></span>
                <span class="menu-title text-truncate">Logout</span>
            </a>
        </li>
    </ul>
</template>

<script>

import { mapActions, mapGetters } from "vuex";
export default {
    created: function () {
        
    },
    methods: {
        ...mapActions(["fetch_logout"]),
        toggle() {
            window.toggleSidebar()
        }
    },
};
</script>

<style></style>
