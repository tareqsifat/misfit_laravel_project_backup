import Layout from '../../views/teacher/pages/news_event/Layout'
import AllNewsEvent from '../../views/teacher/pages/news_event/All'
import DetailsNewsEvent from '../../views/teacher/pages/news_event/Details'

export default {
    path: 'news-events',
    component: Layout,
    props: {
        role_permissions: ['Teacher'],
        layout_title: 'News and events',
    },
    children: [{
            path: '',
            name: 'AllTeacherNewsEvent',
            component: AllNewsEvent,
        },
        {
            path: 'details/:id',
            name: 'DetailsTeacherNewsEvent',
            component: DetailsNewsEvent,
        },
    ],

};
