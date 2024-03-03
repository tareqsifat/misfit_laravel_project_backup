import Layout from '../../views/admin/assets/Layout'
import AllAsset from '../../views/admin/assets/All'
import CreateAsset from '../../views/admin/assets/Create'
import EditAsset from '../../views/admin/assets/Edit'
import DetailsAsset from '../../views/admin/assets/Details'
import ImportAsset from '../../views/admin/assets/Import'

export default {
    path: 'assets',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Asset Management',
    },
    children: [{
            path: '',
            name: 'AllAsset',
            component: AllAsset,
        },
        {
            path: 'import',
            name: 'ImportAsset',
            component: ImportAsset,
        },
        {
            path: 'create',
            name: 'CreateAsset',
            component: CreateAsset,
        },
        {
            path: 'edit/:id',
            name: 'EditAsset',
            component: EditAsset,
        },
        {
            path: 'details/:id',
            name: 'DetailsAsset',
            component: DetailsAsset,
        },
    ],

};
