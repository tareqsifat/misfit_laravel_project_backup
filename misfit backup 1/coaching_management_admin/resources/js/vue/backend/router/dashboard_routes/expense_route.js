import Layout from '../../views/admin/expense/Layout'
import AllExpense from '../../views/admin/expense/All'
import CreateExpense from '../../views/admin/expense/Create'
import EditExpense from '../../views/admin/expense/Edit'
import DetailsExpense from '../../views/admin/expense/Details'
import ImportExpense from '../../views/admin/expense/Import'

export default {
    path: 'expenses',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Expense Management',
    },
    children: [{
            path: '',
            name: 'AllExpense',
            component: AllExpense,
        },
        {
            path: 'import',
            name: 'ImportExpense',
            component: ImportExpense,
        },
        
        {
            path: 'details/:id',
            name: 'DetailsExpense',
            component: DetailsExpense,
        },
    ],

};
