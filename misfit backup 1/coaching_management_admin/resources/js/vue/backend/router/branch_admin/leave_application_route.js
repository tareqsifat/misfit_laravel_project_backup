import Layout from '../../views/branch_admin/pages/leave/Layout'
import AllLeaveApplication from '../../views/branch_admin/pages/leave/All'
import CreateLeaveApplication from '../../views/branch_admin/pages/leave/Create'
import EditLeaveApplication from '../../views/branch_admin/pages/leave/Edit'
import DetailsLeaveApplication from '../../views/branch_admin/pages/leave/Details'
import ImportLeaveApplication from '../../views/branch_admin/pages/leave/Import'

export default {
    path: 'leave-applications',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Leave application Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchLeaveApplication',
            component: AllLeaveApplication,
        },
        {
            path: 'import',
            name: 'ImportBranchLeaveApplication',
            component: ImportLeaveApplication,
        },
        {
            path: 'create',
            name: 'CreateBranchLeaveApplication',
            component: CreateLeaveApplication,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchLeaveApplication',
            component: EditLeaveApplication,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchLeaveApplication',
            component: DetailsLeaveApplication,
        },
    ],

};

