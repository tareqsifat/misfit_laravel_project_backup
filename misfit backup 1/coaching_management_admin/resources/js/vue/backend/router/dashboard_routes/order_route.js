import Layout from '../../views/admin/order/Layout'
import AllOrder from '../../views/admin/order/All'
import CreateOrder from '../../views/admin/order/Create'
import EditOrder from '../../views/admin/order/Edit'
import DetailsOrder from '../../views/admin/order/Details'
import ImportOrder from '../../views/admin/order/Import'

export default {
    path: 'Order',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Order Management',
    },
    children: [
        {
            path: '',
            name: 'AllOrder',
            component: AllOrder,
        },
        {
            path: 'import',
            name: 'ImportOrder',
            component: ImportOrder,
        },
        {
            path: 'create',
            name: 'CreateOrder',
            component: CreateOrder,
        },
        {
            path: 'edit/:id',
            name: 'EditOrder',
            component: EditOrder,
        },
        {
            path: 'details/:id',
            name: 'DetailsOrder',
            component: DetailsOrder,
        },
    ],

};

