<template>
    <div @mouseover="mouseover" @mouseleave="mouseleave">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-home`" :text="`Dashboard`" :alert_count="2">
                <left-nav-list-item :to="'Dashboard'" :text="'Analytics'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-users`" :text="`Users`" :alert_count="0">
                <left-nav-list-item :to="'AllUser'" :text="'All users'" />
                <left-nav-list-item :to="'CreateUser'" :text="'Create user'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-users`" :text="`Roles`" :alert_count="0">
                <left-nav-list-item :to="'AllRole'" :text="'All roles'" />
                <!-- <left-nav-list-item :to="'CreateRole'" :text="'Create role'" /> -->
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-list`" :text="`Contact Message`" :alert_count="0">
                <left-nav-list-item :to="'AllContactMessage'" :text="'All'" />
                <left-nav-list-item :to="'CreateContactMessage'" :text="'Create'" />
            </left-nav-list-group>

            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fas fa-user-shield'" :to="'BranchAdmin'" :text="'Branch Admin'" />

            <li class="navigation-header">
                <span data-i18n="Apps &amp; Pages">managements</span>
            </li>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-building`" :text="`Branches`" :alert_count="0">
                <left-nav-list-item :to="'AllBranch'" :text="'All'" />
                <left-nav-list-item :to="'CreateBranch'" :text="'Create'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin', 'branch_admin']" :icon="`fa-sharp fa-solid fa-money-check`" :text="`Account Management`" :alert_count="0">
                <left-nav-list-item :to="'AllAccountCategory'" :text="'Account category'" />
                <left-nav-list-item :to="'AllAccount'" :text="'Accounts'" />
                <left-nav-list-item :to="'AllIncome'" :text="'Income'" />
                <left-nav-list-item :to="'AllExpense'" :text="'Expense'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-box`" :text="`Product Management`" :alert_count="0">
                <left-nav-list-item :to="'AllProduct'" :text="'All'" />
                <left-nav-list-item :to="'CreateProduct'" :text="'Create'" />
                <left-nav-list-item :to="'StockProduct'" :text="'Product Stock'"/>
                <left-nav-list-item :to="'AllOrder'" :text="'Orders'" />
            </left-nav-list-group>
            
            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-box`" :text="`Assets`" :alert_count="0">
                <left-nav-list-item :to="'AllAsset'" :text="'All'" />
                <left-nav-list-item :to="'CreateAsset'" :text="'Create'" />
            </left-nav-list-group>

            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-file-invoice-dollar'" :to="'AllMonthlyFee'" :text="'Monthly fees'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-chalkboard-user'" :to="'AllClass'" :text="'Classes'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-book'" :to="'AllSubjects'" :text="'Subjects'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-user-group'" :to="'AllBatchs'" :text="'Batch'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-list-check'" :to="'AllExams'" :text="'Exams'" />
            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa-solid fa-calendar-days`" :text="`Time schedules`">
                <left-nav-list-item :to="'AllSchedules'" :text="'Schedules list'"/>
                <left-nav-list-item :to="'TotalSchedules'" :text="'Total Routine'"/>
            </left-nav-list-group>
            <!-- <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-calendar-days'" :to="'AllSchedules'" :text="'Time schedules'" /> -->
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-user-tie'" :to="'AllEmployees'" :text="'Employee Management'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-user-tie'" :to="'AllTeachers'" :text="'Teacher Management'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-graduation-cap'" :to="'AllStudents'" :text="'Student Management'" />

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa-solid fa-user-clock`" :text="`Attendence Management`" :alert_count="0">
                <left-nav-list-item :to="'AllEmployeeAttendences'" :text="'Employee Attendence'" />
                <left-nav-list-item :to="'AllStudentAttendences'" :text="'Student Attendence'" />
            </left-nav-list-group>

            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-money-bills'" :to="'AllSalarys'" :text="'Employee Salary'" />
            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-users-rectangle'" :to="'AllCustomers'" :text="'Customer Management'" />

            

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-envelope`" :text="`Subscribers`" :alert_count="0">
                <left-nav-list-item :to="'AllSubscriber'" :text="'All'" />
                <left-nav-list-item :to="'CreateSubscriber'" :text="'Create'" />
                <left-nav-list-item :to="'SendMailSubscriber'" :text="'Send Mail'" />
            </left-nav-list-group>

            <!-- <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa fa-envelope'" :text="'Email'" :alert_count="15" /> -->
            <!-- <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa fa-envelope'" :text="'Email'" :alert_count="15" /> -->


            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-newspaper'" :to="'AllNewsEvent'" :text="'News & events'" />

            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-bell'" :to="'AllNotice'" :text="'Notice'" />

            <left-nav-list-single :role_permissions="['super_admin']" :icon="'fa-solid fa-rss fa-fade'" :to="'BreakingNews'" :text="'Breaking News'" />

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa fa-gears`" :text="`Settings`" :alert_count="0">
                <left-nav-list-item :to="'AllSetting'" :text="'Site settings'" />
                <left-nav-list-item :to="'SiteLogo'" :text="'Logo and icon'" />
                <left-nav-list-item :to="'AllBanner'" :text="'Banner management'" />
            </left-nav-list-group>

            <left-nav-list-group :role_permissions="['super_admin']" :icon="`fa-solid fa-address-card`" :text="`Profile`" :alert_count="0">
                <left-nav-list-item :to="'settingProfile'" :text="'Profile'" />
                <left-nav-list-item :to="'settingPassword'" :text="'Change Password'" />
            </left-nav-list-group>

            <li class="nav-item mb-5">
                <a @click.prevent="fetch_logout()" class="d-flex align-items-center" href="#">
                    <i class="fa-solid fa-power-off"></i>
                    <span class="menu-title text-truncate" >Logout</span>
                </a>
            </li>
        </ul>

        <nav-time-left-watch></nav-time-left-watch>
    </div>
</template>

<script>
import { mapActions } from 'vuex';
import LeftNavListGroup from './LeftNavListGroup.vue';
import LeftNavListItem from './LeftNavListItem.vue';
import LeftNavListSingle from './LeftNavListSingle.vue';
import NavTimeLeftWatch from "./NavTimeLeftWatch.vue";

export default{
    components: { NavTimeLeftWatch, LeftNavListItem, LeftNavListGroup, LeftNavListSingle },
    data: function(){
        return {
            html: null,
        }
    },
    created: function(){
        this.html = document.querySelector('html');
    },
    methods: {
        ...mapActions(['fetch_logout']),
        mouseover: function(){
            let nav_hide = this.html.classList.contains('nav-hide');
            if(nav_hide){
                this.html.classList.add('nav-hide-hover');
                this.html.classList.remove('nav-hide');
            }
        },
        mouseleave: function(){
            let nav_hide_hover = this.html.classList.contains('nav-hide-hover');
            if(nav_hide_hover){
                this.html.classList.add('nav-hide');
                this.html.classList.remove('nav-hide-hover');
            }
        },
    }
}
</script>

<style>

</style>
