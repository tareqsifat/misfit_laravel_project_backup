import Layout from '../../views/admin/employee_salary/Layout'
import AllSalary from '../../views/admin/employee_salary/All'
import DetailsSalary from '../../views/admin/employee_salary/Details'

export default {
    path: 'admin-control/employee_salary',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Salary Management',
    },
    children: [
        {
            path: '',
            name: 'AllSalarys',
            component: AllSalary,
        },
        {
            path: 'details/:id',
            name: 'DetailsSalary',
            component: DetailsSalary,
        },
    ],

};

