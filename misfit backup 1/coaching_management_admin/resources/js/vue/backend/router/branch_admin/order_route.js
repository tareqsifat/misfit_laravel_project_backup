import Layout from '../../views/branch_admin/pages/order/Layout'
import AllBranchOrder from '../../views/branch_admin/pages/order/All'
import CreateBranchOrder from '../../views/branch_admin/pages/order/Create'
import EditBranchOrder from '../../views/branch_admin/pages/order/Edit'
import DetailsBranchOrder from '../../views/branch_admin/pages/order/Details'
import ImportBranchOrder from '../../views/branch_admin/pages/order/Import'
import AllBranchOrders from '../../views/branch_admin/pages/order/Orders'
import InvoiceBranchOrder from '../../views/branch_admin/pages/order/Invoice'

export default {
    path: 'orders',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Orders',
    },
    children: [
        {
            path: '',
            name: 'AllBranchOrder',
            component: AllBranchOrder,
        },
        {
            path: 'import',
            name: 'ImportBranchOrder',
            component: ImportBranchOrder,
        },
        {
            path: 'create',
            name: 'CreateBranchOrder',
            component: CreateBranchOrder,
        },
        {
            path: 'invoice/:id',
            name: 'InvoiceBranchOrder',
            component: InvoiceBranchOrder,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchOrder',
            component: EditBranchOrder,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchOrder',
            component: DetailsBranchOrder,
        },
    ],

};

