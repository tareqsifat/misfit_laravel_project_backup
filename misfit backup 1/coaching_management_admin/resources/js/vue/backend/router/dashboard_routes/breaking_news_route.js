import Layout from '../../views/admin/breaking_news/Layout'
import AllBreakingNews from '../../views/admin/breaking_news/All'
import CreateBreakingNews from '../../views/admin/breaking_news/Create'
import EditBreakingNews from '../../views/admin/breaking_news/Edit'
import DetailsBreakingNews from '../../views/admin/breaking_news/Details'
import ImportBreakingNews from '../../views/admin/breaking_news/Import'

export default {
    path: 'breaking-news',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Breaking News Management',
    },
    children: [{
            path: '',
            name: 'BreakingNews',
            component: AllBreakingNews,
        },
        {
            path: 'import',
            name: 'ImportBreakingNews',
            component: ImportBreakingNews,
        },
        {
            path: 'create',
            name: 'CreateBreakingNews',
            component: CreateBreakingNews,
        },
        {
            path: 'edit/:id',
            name: 'EditBreakingNews',
            component: EditBreakingNews,
        },
        {
            path: 'details/:id',
            name: 'DetailsBreakingNews',
            component: DetailsBreakingNews,
        },
    ],

};
