import Layout from '../../views/admin/batch/Layout'
import AllBatch from '../../views/admin/batch/All'
import DetailsBatch from '../../views/admin/batch/Details'

export default {
    path: 'admin-control/batch',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Batch Management',
    },
    children: [
        {
            path: '',
            name: 'AllBatchs',
            component: AllBatch,
        },
        {
            path: 'details/:id',
            name: 'DetailsBatch',
            component: DetailsBatch,
        },
    ],

};

