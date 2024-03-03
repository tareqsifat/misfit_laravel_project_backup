import Layout from '../../views/branch_admin/pages/class/Layout'
import AllClass from '../../views/branch_admin/pages/class/All'
import CreateClass from '../../views/branch_admin/pages/class/Create'
import EditClass from '../../views/branch_admin/pages/class/Edit'
import DetailsClass from '../../views/branch_admin/pages/class/Details'
import ImportClass from '../../views/branch_admin/pages/class/Import'

export default {
    path: 'class',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Class Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchClass',
            component: AllClass,
        },
        
        {
            path: 'import',
            name: 'ImportBranchClass',
            component: ImportClass,
        },
        {
            path: 'create',
            name: 'CreateBranchClass',
            component: CreateClass,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchClass',
            component: EditClass,
        },
        
        {
            path: 'details/:id',
            name: 'DetailsBranchClass',
            component: DetailsClass,
        },
    ],

};

