import Layout from '../../views/student/pages/notice/Layout'
import AllNotice from '../../views/student/pages/notice/All'
import DetailsNotice from '../../views/student/pages/notice/Details'

export default {
    path: 'notices',
    component: Layout,
    props: {
        role_permissions: ['Student'],
        layout_title: 'Notice Management',
    },
    children: [{
            path: '',
            name: 'AllStudentNotice',
            component: AllNotice,
        },
    
        {
            path: 'details/:id',
            name: 'DetailsStudentNotice',
            component: DetailsNotice,
        },
    ],

};
