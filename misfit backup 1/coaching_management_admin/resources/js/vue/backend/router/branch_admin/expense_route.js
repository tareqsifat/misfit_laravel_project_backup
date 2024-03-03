import Layout from '../../views/branch_admin/pages/expense/Layout'
import AllExpense from '../../views/branch_admin/pages/expense/All'
import CreateExpense from '../../views/branch_admin/pages/expense/Create'
import EditExpense from '../../views/branch_admin/pages/expense/Edit'
import DetailsExpense from '../../views/branch_admin/pages/expense/Details'
import ImportExpense from '../../views/branch_admin/pages/expense/Import'

export default {
    path: 'accounts/expense',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Expense Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchExpense',
            component: AllExpense,
        },
        {
            path: 'import',
            name: 'ImportBranchExpense',
            component: ImportExpense,
        },
        {
            path: 'create',
            name: 'CreateBranchExpense',
            component: CreateExpense,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchExpense',
            component: EditExpense,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchExpense',
            component: DetailsExpense,
        },
    ],

};

