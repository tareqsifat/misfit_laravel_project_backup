import Layout from '../../views/admin/schedule/Layout'
import AllSchedule from '../../views/admin/schedule/All'
import DetailsSchedule from '../../views/admin/schedule/Details'
import TotalSchedules from '../../views/admin/schedule/Routine'

export default {
    path: 'admin-control/schedule',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Schedule Management',
    },
    children: [
        {
            path: '',
            name: 'AllSchedules',
            component: AllSchedule,
        },
        {
            path: '/total-routine',
            name: 'TotalSchedules',
            component: TotalSchedules,
        },
        {
            path: 'details/:id',
            name: 'DetailsSchedule',
            component: DetailsSchedule,
        },
    ],

};

