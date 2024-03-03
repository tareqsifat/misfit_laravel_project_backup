import Layout from '../../views/admin/account/Layout'
import AllAccount from '../../views/admin/account/All'
import CreateAccount from '../../views/admin/account/Create'
import EditAccount from '../../views/admin/account/Edit'
import DetailsAccount from '../../views/admin/account/Details'
import ImportAccount from '../../views/admin/account/Import'

export default {
    path: 'accounts',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Account Management',
    },
    children: [{
            path: '',
            name: 'AllAccount',
            component: AllAccount,
        },
        {
            path: 'import',
            name: 'ImportAccount',
            component: ImportAccount,
        },
        {
            path: 'details/:id',
            name: 'DetailsAccount',
            component: DetailsAccount,
        },
    ],

};
