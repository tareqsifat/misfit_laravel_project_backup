import Layout from '../../views/branch_admin/pages/income/Layout'
import AllIncome from '../../views/branch_admin/pages/income/All'
import IncomeSheet from '../../views/branch_admin/pages/income/IncomeSheet'
import CreateIncome from '../../views/branch_admin/pages/income/Create'
import EditIncome from '../../views/branch_admin/pages/income/Edit'
import DetailsIncome from '../../views/branch_admin/pages/income/Details'
import ImportIncome from '../../views/branch_admin/pages/income/Import'

export default {
    path: 'accounts/incomes',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Income Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchIncome',
            component: AllIncome,
        },
        {
            path: 'income-sheet',
            name: 'BranchIncomeSheet',
            component: IncomeSheet,
        },
        {
            path: 'import',
            name: 'ImportBranchIncome',
            component: ImportIncome,
        },
        {
            path: 'create',
            name: 'CreateBranchIncome',
            component: CreateIncome,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchIncome',
            component: EditIncome,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchIncome',
            component: DetailsIncome,
        },
    ],

};

