import Layout from '../../views/admin/class/Layout'
import AllClass from '../../views/admin/class/All'
import DetailsClass from '../../views/admin/class/Details'

export default {
    path: 'admin-control/class',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Class Management',
    },
    children: [
        {
            path: '',
            name: 'AllClass',
            component: AllClass,
        },
        {
            path: 'details/:id',
            name: 'DetailsClass',
            component: DetailsClass,
        },
    ],

};

