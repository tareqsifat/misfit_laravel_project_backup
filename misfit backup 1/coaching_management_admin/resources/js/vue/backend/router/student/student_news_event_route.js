import Layout from '../../views/student/pages/news_event/Layout'
import AllNewsEvent from '../../views/student/pages/news_event/All'
import DetailsNewsEvent from '../../views/student/pages/news_event/Details'

export default {
    path: 'news-events',
    component: Layout,
    props: {
        role_permissions: ['Student'],
        layout_title: 'News and event Management',
    },
    children: [{
            path: '',
            name: 'AllStudentNewsEvent',
            component: AllNewsEvent,
        },
        {
            path: 'details/:id',
            name: 'DetailsStudentNewsEvent',
            component: DetailsNewsEvent,
        },
    ],

};
