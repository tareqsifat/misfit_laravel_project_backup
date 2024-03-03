import Layout from '../../views/admin/branch/Layout'
import AllBranch from '../../views/admin/branch/All'
import CreateBranch from '../../views/admin/branch/Create'
import EditBranch from '../../views/admin/branch/Edit'
import DetailsBranch from '../../views/admin/branch/Details'
import ImportBranch from '../../views/admin/branch/Import'
import BranchAdmin from '../../views/admin/branch/BranchAdmin'
import CreateBranchAdmin from '../../views/admin/branch/CreateBranchAdmin'
export default {
    path: 'branch',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Branch Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranch',
            component: AllBranch,
        },
        {
            path: 'branch-admin',
            name: 'BranchAdmin',
            component: BranchAdmin,
        },
        {
            path: 'import',
            name: 'ImportBranch',
            component: ImportBranch,
        },
        {
            path: 'create',
            name: 'CreateBranch',
            component: CreateBranch,
        },
        {
            path: 'create-admin/:id',
            name: 'CreateBranchAdmin',
            component: CreateBranchAdmin,
        },
        {
            path: 'edit/:id',
            name: 'EditBranch',
            component: EditBranch,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranch',
            component: DetailsBranch,
        },
    ],

};
