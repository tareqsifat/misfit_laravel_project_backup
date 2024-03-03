import Layout from '../../views/admin/employee/Layout'
import AllEmployee from '../../views/admin/employee/All'
import DetailsEmployee from '../../views/admin/employee/Details'

export default {
    path: 'admin-control/employee',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Employee Management',
    },
    children: [
        {
            path: '',
            name: 'AllEmployees',
            component: AllEmployee,
        },
        {
            path: 'details/:id',
            name: 'DetailsEmployee',
            component: DetailsEmployee,
        },
    ],

};

