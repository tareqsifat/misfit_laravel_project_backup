import Layout from '../../views/teacher/pages/student_attendence/Layout'
import AllStudentAttendence from '../../views/teacher/pages/student_attendence/All'
import CreateStudentAttendence from '../../views/teacher/pages/student_attendence/Create'
import EditStudentAttendence from '../../views/teacher/pages/student_attendence/Edit'
import DetailsStudentAttendence from '../../views/teacher/pages/student_attendence/Details'
import ImportStudentAttendence from '../../views/teacher/pages/student_attendence/Import'

export default {
    path: 'student-attendences',
    component: Layout,
    props: {
        role_permissions: ['Teacher'],
        layout_title: 'Student Attendence Management',
    },
    children: [
        {
            path: '',
            name: 'AllTeacherStudentAttendence',
            component: AllStudentAttendence,
        },
        {
            path: 'import',
            name: 'ImportTeacherStudentAttendence',
            component: ImportStudentAttendence,
        },
        {
            path: 'create',
            name: 'CreateTeacherStudentAttendence',
            component: CreateStudentAttendence,
        },
        {
            path: 'edit/:id',
            name: 'EditTeacherStudentAttendence',
            component: EditStudentAttendence,
        },
        {
            path: 'details/:id',
            name: 'DetailsTeacherStudentAttendence',
            component: DetailsStudentAttendence,
        },
    ],

};

