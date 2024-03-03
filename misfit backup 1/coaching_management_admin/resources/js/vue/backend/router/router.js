import Vue from 'vue'
import VueRouter from 'vue-router'

import Layout from '../views/admin/Layout'
import Dashboard from '../views/admin/Dashboard'
import Login from '../views/auth/Login'


import user_route from './dashboard_routes/user_route'
import setting_route from './dashboard_routes/setting_route'
import user_role_route from './dashboard_routes/user_role_route'
import contact_meesage_route from './dashboard_routes/contact_meesage_route'
import branch_route from './dashboard_routes/branch_route'
import asset_route from './dashboard_routes/asset_route'
import product_route from './dashboard_routes/product_route'
import order_route from './dashboard_routes/order_route'

import student_route from './student/student_route'
import teacher_route from './teacher/teacher_route'
import branch_admin_route from './branch_admin/branch_admin_route'
import subscriber_route from './dashboard_routes/subscriber_route'
import account_route from './dashboard_routes/account_route'
import account_category_route from './dashboard_routes/account_category_route'
import income_route from './dashboard_routes/income_route'
import expense_route from './dashboard_routes/expense_route'
import monthly_fee_route from './dashboard_routes/monthly_fee_route'
import class_route from './dashboard_routes/class_route'
import subject_route from './dashboard_routes/subject_route'
import batch_route from './dashboard_routes/batch_route'
import exam_route from './dashboard_routes/exam_route'
import schedule_route from './dashboard_routes/schedule_route'
import employee_route from './dashboard_routes/employee_route'
import teacher_management_route from './dashboard_routes/teacher_route'
import student_management_route from './dashboard_routes/student_route'
import salary_route from './dashboard_routes/salary_route'
import customer_route from './dashboard_routes/customer_route'
import employee_attendence_route from './dashboard_routes/employee_attendence_route'
import student_attendence_route from './dashboard_routes/student_attendence_route'
import site_setting_route from './dashboard_routes/site_setting_route'
import news_event_route from './dashboard_routes/news_event_route'
import notice_route from './dashboard_routes/notice_route'
import banner_route from './dashboard_routes/banner_route'
import breaking_news_route from './dashboard_routes/breaking_news_route'

Vue.use(VueRouter);
window.Fire = new Vue();

const routes = [
    {
        path: '/',
        component: Layout,
        children: [
            {
                path: '',
                name: 'Dashboard',
                component: Dashboard,
            },
            account_route,
            account_category_route,
            income_route,
            expense_route,
            setting_route,
            user_route,
            user_role_route,
            contact_meesage_route,
            branch_route,
            asset_route,
            product_route,
            order_route,
            subscriber_route,
            monthly_fee_route,
            class_route,
            subject_route,
            batch_route,
            exam_route,
            schedule_route,
            employee_route,
            teacher_management_route,
            student_management_route,
            salary_route,
            customer_route,
            employee_attendence_route,
            student_attendence_route,
            site_setting_route,
            news_event_route,
            notice_route,
            banner_route,
            breaking_news_route
        ]
    },
    student_route,
    teacher_route,
    branch_admin_route,
    {
        path: '/login',
        name: 'Login',
        component: Login
    }
];

const management_router = new VueRouter({
    routes,
    mode: 'hash',
    linkExactActiveClass: 'active',
    // scrollBehavior: function(to, from, savedPosition) {
    //     return { x: 0, y: 0 }
    // }
});

window.management_router = management_router;

management_router.beforeEach((to, from, next) => {
    let isAuthenticated = window.localStorage?.token?.length ? true : false;
    if (isAuthenticated) {
        window.axios.defaults.headers.common["Authorization"] = `Bearer ${window.localStorage?.token}`;
        next();
    } else {
        delete window.axios.defaults.headers.common["Authorization"];
        window.location.href = '/login'
        return 0;
    }

    // next()
})

export default management_router
