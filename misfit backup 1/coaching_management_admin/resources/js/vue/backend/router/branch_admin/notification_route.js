import Layout from '../../views/branch_admin/pages/notification/Layout'
import AllNotification from '../../views/branch_admin/pages/notification/All'
import CreateNotification from '../../views/branch_admin/pages/notification/Create'
import CreateBulkNotification from '../../views/branch_admin/pages/notification/BulkCreate'
import EditNotification from '../../views/branch_admin/pages/notification/Edit'
import DetailsNotification from '../../views/branch_admin/pages/notification/Details'
import ImportNotification from '../../views/branch_admin/pages/notification/Import'

export default {
    path: 'notifications',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Notification Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchNotification',
            component: AllNotification,
        },
        {
            path: 'import',
            name: 'ImportBranchNotification',
            component: ImportNotification,
        },
        {
            path: 'create',
            name: 'CreateBranchNotification',
            component: CreateNotification,
        },
        {
            path: 'create-bulk',
            name: 'CreateBranchBulkNotification',
            component: CreateBulkNotification,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchNotification',
            component: EditNotification,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchNotification',
            component: DetailsNotification,
        },
    ],

};

