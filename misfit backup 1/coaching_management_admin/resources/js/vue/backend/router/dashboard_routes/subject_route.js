import Layout from '../../views/admin/subject/Layout'
import AllSubject from '../../views/admin/subject/All'
import DetailsSubject from '../../views/admin/subject/Details'

export default {
    path: 'admin-control/subject',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Subject Management',
    },
    children: [
        {
            path: '',
            name: 'AllSubjects',
            component: AllSubject,
        },
        {
            path: 'details/:id',
            name: 'DetailsSubject',
            component: DetailsSubject,
        },
    ],

};

