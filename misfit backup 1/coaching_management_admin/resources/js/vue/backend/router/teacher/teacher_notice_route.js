import Layout from '../../views/teacher/pages/notice/Layout'
import AllNotice from '../../views/teacher/pages/notice/All'
import DetailsNotice from '../../views/teacher/pages/notice/Details'

export default {
    path: 'notices',
    component: Layout,
    props: {
        role_permissions: ['Teacher'],
        layout_title: 'Notices',
    },
    children: [{
            path: '',
            name: 'AllTeacherNotice',
            component: AllNotice,
        },
    
        {
            path: 'details/:id',
            name: 'DetailsTeacherNotice',
            component: DetailsNotice,
        },
    ],

};
