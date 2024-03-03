import Layout from '../../views/branch_admin/pages/employee_salary/Layout'
import AllEmployeeSalary from '../../views/branch_admin/pages/employee_salary/All'
import CreateEmployeeSalary from '../../views/branch_admin/pages/employee_salary/Create'
import EditEmployeeSalary from '../../views/branch_admin/pages/employee_salary/Edit'
import DetailsEmployeeSalary from '../../views/branch_admin/pages/employee_salary/Details'
import ImportEmployeeSalary from '../../views/branch_admin/pages/employee_salary/Import'
import SalarySheet from '../../views/branch_admin/pages/employee_salary/SalarySheet'

export default {
    path: 'employee-salary',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Employee Salary Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchEmployeeSalary',
            component: AllEmployeeSalary,
        },
        {
            path: 'salary-sheet',
            name: 'BranchSalarySheet',
            component: SalarySheet,
        },
        {
            path: 'import',
            name: 'ImportBranchEmployeeSalary',
            component: ImportEmployeeSalary,
        },
        {
            path: 'create',
            name: 'CreateBranchEmployeeSalary',
            component: CreateEmployeeSalary,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchEmployeeSalary',
            component: EditEmployeeSalary,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchEmployeeSalary',
            component: DetailsEmployeeSalary,
        },
    ],

};

