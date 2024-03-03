import AttendenceReport from '../../views/student/pages/attendence/All'
import AttendenceMonthWise from '../../views/student/pages/attendence/MonthlyAttendence'
import Class from '../../views/student/pages/class_routine/All'
import ExamResult from '../../views/student/pages/ExamResult'
import MonthlyFee from '../../views/student/pages/MonthlyFee'
import StudentExamResult from '../../views/student/pages/exam_mark/Result'
import Dashboard from '../../views/student/pages/Dashboard'
import StudentNotification from '../../views/student/pages/Notification'
import StudentNews from '../../views/student/pages/notice/All'
import StudentLayout from '../../views/student/Layout'
import student_news_event_route from './student_news_event_route'
import student_notice_route from './student_notice_route'

export default {
    path: '/student',
    component: StudentLayout,
    children: [
        {
            path: '',
            name: 'student_dashboard',
            component: Dashboard,
        },
        {
            path: 'notification',
            name: 'student_notification',
            component: StudentNotification,
        },
        {
            path: 'news',
            name: 'student_news',
            component: StudentNews,
        },
        {
            path: 'attendence',
            name: 'AttendenceReport',
            component: AttendenceReport,
        },
        {
            path: 'monthly-attendence',
            name: 'AttendenceMonthWise',
            component: AttendenceMonthWise,
        },
        {
            path: 'class',
            name: 'class_routine',
            component: Class,
        },
        {
            path: 'exam-result',
            name: 'exam_result',
            component: ExamResult,
        },
        {
            path: 'monthly-fees',
            name: 'StudentMonthlyFee',
            component: MonthlyFee,
        },
        {
            path: 'exam-results',
            name: 'StudentExamResult',
            component: StudentExamResult,
        },
        student_news_event_route,
        student_notice_route,
    ]
};
