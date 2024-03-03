import Exam from '../../views/teacher/pages/Exam'
import Class from '../../views/teacher/pages/class_routine/All'
import Exams from '../../views/teacher/pages/exam/All'
import ExamResult from '../../views/teacher/pages/exam/Result'
import TeacherAttendence from '../../views/teacher/pages/attendence/All'
import SalaryStatements from '../../views/teacher/pages/employee_salary/All'
import Dashboard from '../../views/teacher/pages/Dashboard'
import TeacherNotification from '../../views/teacher/pages/Notification'
import TeacherLayout from '../../views/teacher/Layout'
import teacher_news_event_route from './teacher_news_event_route'
import teacher_notice_route from './teacher_notice_route'
import teacher_student_attendence_route from './teacher_student_attendence_route'

export default {
    path: '/teacher',
    component: TeacherLayout,
    props: {
        role_permissions: ['Teacher'],
    },
    children: [
        {
            path: '',
            name: 'teacher_dashboard',
            component: Dashboard,
        },
        // {
        //     path: 'exam',
        //     name: 'exam_routine',
        //     component: Exam,
        // },
        {
            path: 'notification',
            name: 'teacher_notification',
            component: TeacherNotification,
        },
        {
            path: 'exam-result/:id',
            name: 'ExamResult',
            component: ExamResult,
        },
        {
            path: 'exams',
            name: 'Exams',
            component: Exams,
        },
        {
            path: 'class-schedule',
            name: 'class_schedule',
            component: Class,
        },
        {
            path: 'attendences',
            name: 'TeacherAttendence',
            component: TeacherAttendence,
        },
        {
            path: 'salary-statements',
            name: 'SalaryStatement',
            component: SalaryStatements,
        },
        teacher_news_event_route,
        teacher_notice_route,
        teacher_student_attendence_route
    ]
};
