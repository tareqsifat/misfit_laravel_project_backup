import Layout from '../../views/branch_admin/pages/account_category/Layout'
import AllAccountCategory from '../../views/branch_admin/pages/account_category/All'
import CreateAccountCategory from '../../views/branch_admin/pages/account_category/Create'
import EditAccountCategory from '../../views/branch_admin/pages/account_category/Edit'
import DetailsAccountCategory from '../../views/branch_admin/pages/account_category/Details'
import ImportAccountCategory from '../../views/branch_admin/pages/account_category/Import'
import ExpenseAccountCategory from '../../views/branch_admin/pages/account_category/Expense';
import IncomeAccountCategory from '../../views/branch_admin/pages/account_category/Income';

export default {
    path: 'account-category',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'AccountCategory Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchAccountCategory',
            component: AllAccountCategory,
        },
        {
            path: 'import',
            name: 'ImportBranchAccountCategory',
            component: ImportAccountCategory,
        },
        {
            path: 'expenses',
            name: 'ExpenseBranchAccountCategory',
            component: ExpenseAccountCategory,
        },
        {
            path: 'incomes',
            name: 'IncomeBranchAccountCategory',
            component: IncomeAccountCategory,
        },
        {
            path: 'create',
            name: 'CreateBranchAccountCategory',
            component: CreateAccountCategory,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchAccountCategory',
            component: EditAccountCategory,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchAccountCategory',
            component: DetailsAccountCategory,
        },
    ],

};

