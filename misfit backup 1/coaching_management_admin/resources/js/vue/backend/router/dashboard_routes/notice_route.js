import Layout from '../../views/admin/notice/Layout'
import AllNotice from '../../views/admin/notice/All'
import CreateNotice from '../../views/admin/notice/Create'
import EditNotice from '../../views/admin/notice/Edit'
import DetailsNotice from '../../views/admin/notice/Details'
import ImportNotice from '../../views/admin/notice/Import'

export default {
    path: 'notices',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Notice Management',
    },
    children: [{
            path: '',
            name: 'AllNotice',
            component: AllNotice,
        },
        {
            path: 'import',
            name: 'ImportNotice',
            component: ImportNotice,
        },
        {
            path: 'create',
            name: 'CreateNotice',
            component: CreateNotice,
        },
        {
            path: 'edit/:id',
            name: 'EditNotice',
            component: EditNotice,
        },
        {
            path: 'details/:id',
            name: 'DetailsNotice',
            component: DetailsNotice,
        },
    ],

};
