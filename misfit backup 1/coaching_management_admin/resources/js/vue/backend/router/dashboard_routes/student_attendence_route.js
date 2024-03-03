import Layout from '../../views/admin/student_attendences/Layout'
import AllStudentAttendence from '../../views/admin/student_attendences/All'
import DetailsStudentAttendence from '../../views/admin/student_attendences/Details'

export default {
    path: 'admin-control/student_attendence',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Student Attendence Management',
    },
    children: [
        {
            path: '',
            name: 'AllStudentAttendences',
            component: AllStudentAttendence,
        },
        {
            path: 'details/:id',
            name: 'DetailsStudentAttendence',
            component: DetailsStudentAttendence,
        },
    ],

};

