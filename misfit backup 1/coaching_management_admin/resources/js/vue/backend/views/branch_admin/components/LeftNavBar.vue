<template>
    <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'branch_dashboard' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-sharp fa-solid fa-house"></i></span>
                <span class="menu-title text-truncate">Dashboard</span>
            </router-link>
        </li>


        <!-- <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchAccount' }" href="#">
                <span class="icon"><i class="fa-sharp fa-solid fa-money-check"></i></span>
                <span class="menu-title text-truncate">Accounts</span>
            </router-link>
        </li> -->
        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-sharp fa-solid fa-money-check"></i>
                <span class="menu-title text-truncate">Account Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>

            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchAccountCategory' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Account Category</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchAccount' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Accounts</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'BranchIncomeSheet' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Income Sheet</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'BranchExpenseSheet' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Expense Sheet</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchIncome' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Income</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchExpense' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Expense</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AccountBalanceTransfer' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Transfer balance</span>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchMonthlyFee' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-solid fa-file-invoice-dollar"></i></span>
                <span class="menu-title text-truncate">Monthly fees</span>
            </router-link>
        </li>

        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="menu-title text-truncate">Product Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>

            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'branch_product' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">All products</span>
                    </router-link>
                </li>

                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'CreateBranchProductOrder' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Bulk order</span>
                    </router-link>
                </li>
                
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchOrder' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">All Orders</span>
                    </router-link>
                </li>
            </ul>
        </li>

        <!-- <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'branch_product' }" href="#">
                <span class="icon"><i class="fa-solid fa-cart-shopping"></i></span>
                <span class="menu-title text-truncate">Product</span>
            </router-link>
        </li> -->

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchClass' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-solid fa-chalkboard-user"></i></span>
                <span class="menu-title text-truncate">Class</span>
            </router-link>
        </li>

        

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchBatch' }" href="#">
                <!-- <i class="fa-solid fa-box"></i> -->
                <span class="icon"><i class="fa-solid fa-user-group"></i></span>
                <span class="menu-title text-truncate">Batch</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchExam' }" href="#">
                <i class="fa-solid fa-list-check"></i>
                <span class="menu-title text-truncate">Exam Management</span>
            </router-link>
        </li>

        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-calendar-days"></i>
                <span class="menu-title text-truncate">Schedule Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>

            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'RoutineBranchSchedule' }" href="#">
                        <!-- <i class="fa-solid fa-box"></i> -->
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Total Routine</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'CreateBranchSchedule' }" href="#">
                        <!-- <i class="fa-solid fa-box"></i> -->
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Create schedules</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchSchedule' }" href="#">
                        <!-- <i class="fa-solid fa-box"></i> -->
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">All schedules</span>
                    </router-link>
                </li>
                
            </ul>
        </li>
        
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchEmployee' }" href="#">
                <i class="fa-solid fa-user-tie"></i>
                <span class="menu-title text-truncate">Employee Management</span>
            </router-link>
        </li>

        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchTeacher' }" href="#">
                <i class="fa-solid fa-user-tie"></i>
                <span class="menu-title text-truncate">Teacher Management</span>
            </router-link>
        </li>

    
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchStudent' }" href="#">
                <i class="fa-solid fa-graduation-cap"></i>
                <span class="menu-title text-truncate">Student Management</span>
            </router-link>
        </li>

        
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchLeaveApplication' }" href="#">
                <i class="fas fa-file-alt"></i>
                <span class="menu-title text-truncate">Leave Management</span>
            </router-link>
        </li>
        <!-- <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchStudentAttendence' }" href="#">
                <i class="fa-solid fa-user-clock"></i>
                <span class="menu-title text-truncate">Student attendence</span>
            </router-link>
        </li> -->


        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-user-clock"></i>
                <span class="menu-title text-truncate">Attendence Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>

            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchEmployeeAttendence' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Employee attendence</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchStudentAttendence' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Student attendence</span>
                    </router-link>
                </li>
            </ul>
        </li>

        

        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-money-bills"></i>
                <span class="menu-title text-truncate">Salary Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>

            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchEmployeeSalary' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Employee salary</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'BranchSalarySheet' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Salary Sheet</span>
                    </router-link>
                </li>
            </ul>
        </li>
        
        

        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-users-rectangle"></i>
                <span class="menu-title text-truncate">Customer Management</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>
            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchCustomer' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">All Customers</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchTopic' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Topics</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchCall' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Call history</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchSms' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Sms history</span>
                    </router-link>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="d-flex align-items-center nested_nav_list_sidebar" href="javascript:void(0)">
                <i class="fa-solid fa-bell"></i>
                <span class="menu-title text-truncate">Notification</span>
                <i class="ms-1 fa-solid fa-caret-down"></i>
            </a>
            <ul class="nested_list_sidebar">
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'AllBranchNotification' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Notifications</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'CreateBranchNotification' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Create Notification</span>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link class="d-flex align-items-center" :to="{ name: 'CreateBranchBulkNotification' }" href="#">
                        <i class="fa-regular fa-circle"></i>
                        <span class="menu-title text-truncate">Bulk Notification</span>
                    </router-link>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <router-link class="d-flex align-items-center" :to="{ name: 'branch_notification' }" href="#">
                <i class="fa-solid fa-bell"></i>
                <span class="menu-title text-truncate">My Notifications</span>
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
        setTimeout(() => {
            $(".nav-item").click(function() {
                $(this).children('.nested_list_sidebar').toggleClass("active");
            });
        }, 500);
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
