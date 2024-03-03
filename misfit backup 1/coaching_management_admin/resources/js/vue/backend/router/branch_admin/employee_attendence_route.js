import Layout from '../../views/branch_admin/pages/employee_attendence/Layout'
import AllEmployeeAttendence from '../../views/branch_admin/pages/employee_attendence/All'
import CreateEmployeeAttendence from '../../views/branch_admin/pages/employee_attendence/Create'
import EditEmployeeAttendence from '../../views/branch_admin/pages/employee_attendence/Edit'
import DetailsEmployeeAttendence from '../../views/branch_admin/pages/employee_attendence/Details'
import ImportEmployeeAttendence from '../../views/branch_admin/pages/employee_attendence/Import'

export default {
    path: 'employee-attendences',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Employee Attendence Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchEmployeeAttendence',
            component: AllEmployeeAttendence,
        },
        {
            path: 'import',
            name: 'ImportBranchEmployeeAttendence',
            component: ImportEmployeeAttendence,
        },
        {
            path: 'create',
            name: 'CreateBranchEmployeeAttendence',
            component: CreateEmployeeAttendence,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchEmployeeAttendence',
            component: EditEmployeeAttendence,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchEmployeeAttendence',
            component: DetailsEmployeeAttendence,
        },
    ],

};

