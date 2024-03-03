import Layout from '../../views/branch_admin/pages/call_history/Layout'
import AllCall from '../../views/branch_admin/pages/call_history/All'
import CreateCall from '../../views/branch_admin/pages/call_history/Create'
import EditCall from '../../views/branch_admin/pages/call_history/Edit'
import DetailsCall from '../../views/branch_admin/pages/call_history/Details'
import ImportCall from '../../views/branch_admin/pages/call_history/Import'

export default {
    path: 'calls',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Call Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchCall',
            component: AllCall,
        },
        {
            path: 'import',
            name: 'ImportBranchCall',
            component: ImportCall,
        },
        {
            path: 'create',
            name: 'CreateBranchCall',
            component: CreateCall,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchCall',
            component: EditCall,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchCall',
            component: DetailsCall,
        },
    ],

};

