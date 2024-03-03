import Layout from '../../views/admin/exam/Layout'
import AllExam from '../../views/admin/exam/All'
import DetailsExam from '../../views/admin/exam/Details'

export default {
    path: 'admin-control/exams',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Exam Management',
    },
    children: [{
            path: '',
            name: 'AllExams',
            component: AllExam,
        },
        {
            path: 'details/:id',
            name: 'DetailsExam',
            component: DetailsExam,
        },
    ],

};
