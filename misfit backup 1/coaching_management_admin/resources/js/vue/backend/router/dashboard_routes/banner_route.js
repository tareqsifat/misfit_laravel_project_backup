import Layout from '../../views/admin/banner/Layout'
import AllBanner from '../../views/admin/banner/All'
import CreateBanner from '../../views/admin/banner/Create'
import EditBanner from '../../views/admin/banner/Edit'
import DetailsBanner from '../../views/admin/banner/Details'
import ImportBanner from '../../views/admin/banner/Import'

export default {
    path: 'banner',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Banner Management',
    },
    children: [{
            path: '',
            name: 'AllBanner',
            component: AllBanner,
        },
        {
            path: 'import',
            name: 'ImportBanner',
            component: ImportBanner,
        },
        {
            path: 'create',
            name: 'CreateBanner',
            component: CreateBanner,
        },
        {
            path: 'edit/:id',
            name: 'EditBanner',
            component: EditBanner,
        },
        {
            path: 'details/:id',
            name: 'DetailsBanner',
            component: DetailsBanner,
        },
    ],

};
