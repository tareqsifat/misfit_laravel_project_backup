import Layout from '../../views/admin/income/Layout'
import AllIncome from '../../views/admin/income/All'
import CreateIncome from '../../views/admin/income/Create'
import EditIncome from '../../views/admin/income/Edit'
import DetailsIncome from '../../views/admin/income/Details'
import ImportIncome from '../../views/admin/income/Import'

export default {
    path: 'incomes',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Incomes',
    },
    children: [{
            path: '',
            name: 'AllIncome',
            component: AllIncome,
        },
        {
            path: 'import',
            name: 'ImportIncome',
            component: ImportIncome,
        },
        {
            path: 'details/:id',
            name: 'DetailsIncome',
            component: DetailsIncome,
        },
    ],

};
