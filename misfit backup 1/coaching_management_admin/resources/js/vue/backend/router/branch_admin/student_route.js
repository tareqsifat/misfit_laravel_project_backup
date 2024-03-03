import Layout from '../../views/branch_admin/pages/student/Layout'
import AllStudent from '../../views/branch_admin/pages/student/All'
import CreateStudent from '../../views/branch_admin/pages/student/Create'
import EditStudent from '../../views/branch_admin/pages/student/Edit'
import DetailsStudent from '../../views/branch_admin/pages/student/Details'
import ImportStudent from '../../views/branch_admin/pages/student/Import'
import ResultStudent from '../../views/branch_admin/pages/student/StudentResult'
import AttendenceStudent from '../../views/branch_admin/pages/student/StudentAttendence'
import IdCardStudent from '../../views/branch_admin/pages/student/Idcard'

export default {
    path: 'students',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Student Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchStudent',
            component: AllStudent,
        },
        {
            path: 'import',
            name: 'ImportBranchStudent',
            component: ImportStudent,
        },
        {
            path: 'create',
            name: 'CreateBranchStudent',
            component: CreateStudent,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchStudent',
            component: EditStudent,
        },
        {
            path: 'id-card/:id',
            name: 'IdCardBranchStudent',
            component: IdCardStudent,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchStudent',
            component: DetailsStudent,
        },
        {
            path: 'result/:id',
            name: 'ResultBranchStudent',
            component: ResultStudent,
        },
        {
            path: 'attendence/:id',
            name: 'AttendenceBranchStudent',
            component: AttendenceStudent,
        },
    ],

};

