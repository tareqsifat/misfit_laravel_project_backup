import Layout from '../../views/admin/news_event/Layout'
import AllNewsEvent from '../../views/admin/news_event/All'
import CreateNewsEvent from '../../views/admin/news_event/Create'
import EditNewsEvent from '../../views/admin/news_event/Edit'
import DetailsNewsEvent from '../../views/admin/news_event/Details'
import ImportNewsEvent from '../../views/admin/news_event/Import'

export default {
    path: 'news-events',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'News and event Management',
    },
    children: [{
            path: '',
            name: 'AllNewsEvent',
            component: AllNewsEvent,
        },
        {
            path: 'import',
            name: 'ImportNewsEvent',
            component: ImportNewsEvent,
        },
        {
            path: 'create',
            name: 'CreateNewsEvent',
            component: CreateNewsEvent,
        },
        {
            path: 'edit/:id',
            name: 'EditNewsEvent',
            component: EditNewsEvent,
        },
        {
            path: 'details/:id',
            name: 'DetailsNewsEvent',
            component: DetailsNewsEvent,
        },
    ],

};
