import Layout from '../../views/admin/student/Layout'
import AllStudent from '../../views/admin/student/All'
import DetailsStudent from '../../views/admin/student/Details'
import CreateStudent from '../../views/admin/student/Create'
import EditStudent from '../../views/admin/student/Edit'

export default {
    path: 'admin-control/student',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Student Management',
    },
    children: [
        {
            path: '',
            name: 'AllStudents',
            component: AllStudent,
        },
        {
            path: 'create',
            name: 'CreateStudent',
            component: CreateStudent,
        },
        {
            path: 'edit/:id',
            name: 'EditStudent',
            component: EditStudent,
        },
        {
            path: 'details/:id',
            name: 'DetailsStudent',
            component: DetailsStudent,
        },
    ],

};

