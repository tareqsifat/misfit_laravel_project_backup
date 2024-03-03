import Layout from '../../views/branch_admin/pages/employee/Layout'
import AllEmployee from '../../views/branch_admin/pages/employee/All'
import CreateEmployee from '../../views/branch_admin/pages/employee/Create'
import EditEmployee from '../../views/branch_admin/pages/employee/Edit'
import DetailsEmployee from '../../views/branch_admin/pages/employee/Details'
import ImportEmployee from '../../views/branch_admin/pages/employee/Import'

export default {
    path: 'employees',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Employee Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchEmployee',
            component: AllEmployee,
        },
        {
            path: 'import',
            name: 'ImportBranchEmployee',
            component: ImportEmployee,
        },
        {
            path: 'create',
            name: 'CreateBranchEmployee',
            component: CreateEmployee,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchEmployee',
            component: EditEmployee,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchEmployee',
            component: DetailsEmployee,
        },
    ],

};

