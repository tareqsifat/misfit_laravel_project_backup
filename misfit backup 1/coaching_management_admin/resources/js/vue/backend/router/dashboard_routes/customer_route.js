import Layout from '../../views/admin/customer/Layout'
import AllCustomer from '../../views/admin/customer/All'
import DetailsCustomer from '../../views/admin/customer/Details'

export default {
    path: 'admin-control/customer',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Customer Management',
    },
    children: [
        {
            path: '',
            name: 'AllCustomers',
            component: AllCustomer,
        },
        {
            path: 'details/:id',
            name: 'DetailsCustomer',
            component: DetailsCustomer,
        },
    ],

};

