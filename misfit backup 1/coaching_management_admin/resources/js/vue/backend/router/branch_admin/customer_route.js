import Layout from '../../views/branch_admin/pages/customer/Layout'
import AllCustomer from '../../views/branch_admin/pages/customer/All'
import CreateCustomer from '../../views/branch_admin/pages/customer/Create'
import EditCustomer from '../../views/branch_admin/pages/customer/Edit'
import DetailsCustomer from '../../views/branch_admin/pages/customer/Details'
import ImportCustomer from '../../views/branch_admin/pages/customer/Import'

export default {
    path: 'customers',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Customer Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchCustomer',
            component: AllCustomer,
        },
        {
            path: 'import',
            name: 'ImportBranchCustomer',
            component: ImportCustomer,
        },
        {
            path: 'create',
            name: 'CreateBranchCustomer',
            component: CreateCustomer,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchCustomer',
            component: EditCustomer,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchCustomer',
            component: DetailsCustomer,
        },
    ],

};

