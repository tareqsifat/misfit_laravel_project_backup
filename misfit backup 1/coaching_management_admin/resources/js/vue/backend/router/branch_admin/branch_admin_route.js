import Product from '../../views/branch_admin/pages/product/All'
import Class from '../../views/branch_admin/pages/ClassRoutine'
import ExamResult from '../../views/branch_admin/pages/ExamResult'
import Dashboard from '../../views/branch_admin/pages/Dashboard'
import Notification from '../../views/branch_admin/pages/Notification'
import BranchLayout from '../../views/branch_admin/Layout'
import product_route from './product_route'
import account_route from './account_route'
import class_route from './class_route'
import batch_route from './batch_route'
import subject_route from './subject_route'
import schedule_route from './schedule_route'
import student_route from './student_route'
import customer_route from './customer_route'
import topic_route from './topic_route'
import call_route from './call_route'
import sms_route from './sms_route'
import teacher_route from './teacher_route'
import exam_route from './exam_route'
import employee_route from './employee_route'
import student_attendence_route from './student_attendence_route'
import employee_attendence_route from './employee_attendence_route'
import salary_route from './salary_route'
import notification_route from './notification_route'
import expense_route from './expense_route'
import income_route from './income_route'
import account_category_route from './account_category_route'
import monthly_fee_route from './monthly_fee_route'
import order_route from './order_route'
import leave_application_route from './leave_application_route'

export default {
    path: '/branch-admin',
    component: BranchLayout,
    props: {
        role_permissions: ['branch_admin'],
    },
    children: [
        {
            path: '',
            name: 'branch_dashboard',
            component: Dashboard,
        },
        {
            path: 'notification',
            name: 'branch_notification',
            component: Notification,
        },
        {
            path: 'product',
            name: 'branch_product',
            component: Product,
        },
        {
            path: 'class-schedule',
            name: 'class_schedule',
            component: Class,
        },
        {
            path: 'exam-reports',
            name: 'exam_reports',
            component: ExamResult,
        },
        product_route,
        account_route,
        class_route,
        batch_route,
        subject_route,
        schedule_route,
        student_route,
        teacher_route,
        customer_route,
        topic_route,
        call_route,
        sms_route,
        exam_route,
        employee_route,
        student_attendence_route,
        employee_attendence_route,
        salary_route,
        notification_route,
        expense_route,
        income_route,
        account_category_route,
        monthly_fee_route,
        order_route,
        leave_application_route
    ]
};
