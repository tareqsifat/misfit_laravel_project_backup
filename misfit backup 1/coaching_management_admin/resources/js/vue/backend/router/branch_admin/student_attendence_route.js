import Layout from '../../views/branch_admin/pages/student_attendence/Layout'
import AllStudentAttendence from '../../views/branch_admin/pages/student_attendence/All'
import CreateStudentAttendence from '../../views/branch_admin/pages/student_attendence/Create'
import EditStudentAttendence from '../../views/branch_admin/pages/student_attendence/Edit'
import DetailsStudentAttendence from '../../views/branch_admin/pages/student_attendence/Details'
import ImportStudentAttendence from '../../views/branch_admin/pages/student_attendence/Import'

export default {
    path: 'student-attendences',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'StudentAttendence Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchStudentAttendence',
            component: AllStudentAttendence,
        },
        {
            path: 'import',
            name: 'ImportBranchStudentAttendence',
            component: ImportStudentAttendence,
        },
        {
            path: 'create',
            name: 'CreateBranchStudentAttendence',
            component: CreateStudentAttendence,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchStudentAttendence',
            component: EditStudentAttendence,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchStudentAttendence',
            component: DetailsStudentAttendence,
        },
    ],

};

