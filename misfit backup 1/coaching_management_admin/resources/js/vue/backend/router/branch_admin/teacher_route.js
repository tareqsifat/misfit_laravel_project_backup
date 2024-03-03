import Layout from '../../views/branch_admin/pages/teacher/Layout'
import AllTeacher from '../../views/branch_admin/pages/teacher/All'
import CreateTeacher from '../../views/branch_admin/pages/teacher/Create'
import EditTeacher from '../../views/branch_admin/pages/teacher/Edit'
import DetailsTeacher from '../../views/branch_admin/pages/teacher/Details'
import ImportTeacher from '../../views/branch_admin/pages/teacher/Import'
import AttendenceTeacher from '../../views/branch_admin/pages/teacher/TeacherAttendence'
import ScheduleTeacher from '../../views/branch_admin/pages/teacher/TeacherSchedule'

export default {
    path: 'teachers',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Teacher Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchTeacher',
            component: AllTeacher,
        },
        {
            path: 'import',
            name: 'ImportBranchTeacher',
            component: ImportTeacher,
        },
        {
            path: 'create',
            name: 'CreateBranchTeacher',
            component: CreateTeacher,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchTeacher',
            component: EditTeacher,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchTeacher',
            component: DetailsTeacher,
        },
        {
            path: 'schedules/:id',
            name: 'ScheduleBranchTeacher',
            component: ScheduleTeacher,
        },
        {
            path: 'attendence/:id',
            name: 'AttendenceBranchTeacher',
            component: AttendenceTeacher,
        },
    ],

};

