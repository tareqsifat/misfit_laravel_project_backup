import Vue from 'vue';
import Vuex from 'vuex';
// import createPersistedState from "vuex-persistedstate";
Vue.use(Vuex);

import auth_modules from './modules/auth_modules';
import user_modules from './modules/user_modules';
import user_role_modules from './modules/user_role_modules';
import user_contact_message_modules from './modules/user_contact_message_modules';
import asset_modules from './modules/asset_modules';
import branch_modules from './modules/branch_modules';
import product_modules from './modules/product_modules';
import order_modules from './modules/order_modules';
import account_modules from './modules/account_modules';
import account_modules_admin from './modules/account_modules_admin';
import class_modules from './modules/class_modules';
import batch_modules from './modules/batch_modules';
import batch_modules_admin from './modules/batch_modules_admin';
import subject_modules from './modules/subject_modules';
import subject_modules_admin from './modules/subject_modules_admin';
import schedule_modules from './modules/schedule_modules';
import schedule_modules_admin from './modules/schedule_modules_admin';
import student_modules from './modules/student_modules';
import student_modules_admin from './modules/student_modules_admin';
import customer_modules from './modules/customer_modules';
import customer_modules_admin from './modules/customer_modules_admin';
import topic_modules from './modules/topic_modules';
import call_modules from './modules/call_modules';
import sms_modules from './modules/sms_modules';
import teacher_modules from './modules/teacher_modules';
import teacher_modules_admin from './modules/teacher_modules_admin';
import exam_modules from './modules/exam_modules';
import exam_modules_admin from './modules/exam_modules_admin';
import employee_modules from './modules/employee_modules';
import employee_modules_admin from './modules/employee_modules_admin';
import student_attendence_modules from './modules/student_attendence_modules';
import student_attendence_modules_admin from './modules/student_attendence_modules_admin';
import employee_attendence_modules from './modules/employee_attendence_modules';
import employee_attendence_modules_admin from './modules/employee_attendence_modules_admin';
import employee_salary_modules from './modules/employee_salary_modules';
import notification_modules from './modules/notification_modules';
import subscriber_modules from './modules/subscriber_modules';
import expense_modules from './modules/expense_modules';
import expense_modules_admin from './modules/expense_modules_admin';
import income_modules from './modules/income_modules';
import income_modules_admin from './modules/income_modules_admin';
import account_category_modules from './modules/account_category_modules';
import monthly_fee_modules from './modules/monthly_fee_modules';
import monthly_fee_modules_admin from './modules/monthly_fee_modules_admin';
import class_modules_admin from './modules/class_modules_admin';
import employee_salary_modules_admin from './modules/employee_salary_modules_admin';
import dashboard_modules from './modules/dashboard_modules';
import site_setting_modules from './modules/site_setting_modules';
import news_event_modules from './modules/news_event_modules';
import notice_modules from './modules/notice_modules';
import banner_modules from './modules/banner_modules';
import leave_application_modules from './modules/leave_application_modules';
import breaking_news_modules from './modules/breaking_news_modules'

const store = new Vuex.Store({
    modules: {
        auth_modules,
        user_modules,
        user_role_modules,
        user_contact_message_modules,
        branch_modules,
        asset_modules,
        product_modules,
        order_modules,
        account_modules,
        account_modules_admin,
        class_modules,
        class_modules_admin,
        batch_modules,
        batch_modules_admin,
        subject_modules,
        subject_modules_admin,
        schedule_modules,
        schedule_modules_admin,
        student_modules,
        student_modules_admin,
        customer_modules,
        customer_modules_admin,
        topic_modules,
        call_modules,
        sms_modules,
        teacher_modules,
        teacher_modules_admin,
        exam_modules,
        exam_modules_admin,
        employee_modules,
        employee_modules_admin,
        student_attendence_modules,
        student_attendence_modules_admin,
        employee_attendence_modules,
        employee_attendence_modules_admin,
        employee_salary_modules,
        notification_modules,
        subscriber_modules,
        expense_modules,
        expense_modules_admin,
        income_modules,
        income_modules_admin,   
        account_category_modules,
        monthly_fee_modules,
        monthly_fee_modules_admin,
        employee_salary_modules_admin,
        dashboard_modules,
        site_setting_modules,
        news_event_modules,
        notice_modules,
        banner_modules,
        leave_application_modules,
        breaking_news_modules
    },
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    // plugins: [createPersistedState()],
});

export default store;
