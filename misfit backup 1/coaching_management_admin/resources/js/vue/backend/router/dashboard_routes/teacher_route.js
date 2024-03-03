import Layout from '../../views/admin/teacher/Layout'
import AllTeacher from '../../views/admin/teacher/All'
import DetailsTeacher from '../../views/admin/teacher/Details'

export default {
    path: 'admin-control/teacher',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Teacher Management',
    },
    children: [
        {
            path: '',
            name: 'AllTeachers',
            component: AllTeacher,
        },
        {
            path: 'details/:id',
            name: 'DetailsTeacher',
            component: DetailsTeacher,
        },
    ],

};

