import Layout from '../../views/admin/account_category/Layout'
import AllAccountCategory from '../../views/admin/account_category/All'
import CreateAccountCategory from '../../views/admin/account_category/Create'
import EditAccountCategory from '../../views/admin/account_category/Edit'
import DetailsAccountCategory from '../../views/admin/account_category/Details'
import ImportAccountCategory from '../../views/admin/account_category/Import'

export default {
    path: 'account-category',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Account Category Management',
    },
    children: [{
            path: '',
            name: 'AllAccountCategory',
            component: AllAccountCategory,
        },
        {
            path: 'import',
            name: 'ImportAccountCategory',
            component: ImportAccountCategory,
        },
        {
            path: 'create',
            name: 'CreateAccountCategory',
            component: CreateAccountCategory,
        },
        {
            path: 'edit/:id',
            name: 'EditAccountCategory',
            component: EditAccountCategory,
        },
        {
            path: 'details/:id',
            name: 'DetailsAccountCategory',
            component: DetailsAccountCategory,
        },
    ],

};
