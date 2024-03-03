import Layout from '../../views/branch_admin/pages/topic/Layout'
import AllTopic from '../../views/branch_admin/pages/topic/All'
import CreateTopic from '../../views/branch_admin/pages/topic/Create'
import EditTopic from '../../views/branch_admin/pages/topic/Edit'
import DetailsTopic from '../../views/branch_admin/pages/topic/Details'
import ImportTopic from '../../views/branch_admin/pages/topic/Import'

export default {
    path: 'topics',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Topic Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchTopic',
            component: AllTopic,
        },
        {
            path: 'import',
            name: 'ImportBranchTopic',
            component: ImportTopic,
        },
        {
            path: 'create',
            name: 'CreateBranchTopic',
            component: CreateTopic,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchTopic',
            component: EditTopic,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchTopic',
            component: DetailsTopic,
        },
    ],

};

