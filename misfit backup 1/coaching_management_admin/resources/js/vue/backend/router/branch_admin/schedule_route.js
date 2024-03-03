import Layout from '../../views/branch_admin/pages/schedule/Layout'
import AllSchedule from '../../views/branch_admin/pages/schedule/All'
import CreateSchedule from '../../views/branch_admin/pages/schedule/Create'
import EditSchedule from '../../views/branch_admin/pages/schedule/Edit'
import DetailsSchedule from '../../views/branch_admin/pages/schedule/Details'
import RoutineSchedule from '../../views/branch_admin/pages/schedule/Routine'
import ImportSchedule from '../../views/branch_admin/pages/schedule/Import'

export default {
    path: 'schedule',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Schedule Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchSchedule',
            component: AllSchedule,
        },
        {
            path: 'import',
            name: 'ImportBranchSchedule',
            component: ImportSchedule,
        },
        {
            path: 'create',
            name: 'CreateBranchSchedule',
            component: CreateSchedule,
        },
        {
            path: 'routine',
            name: 'RoutineBranchSchedule',
            component: RoutineSchedule,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchSchedule',
            component: EditSchedule,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchSchedule',
            component: DetailsSchedule,
        },
    ],

};

