import Layout from '../../views/branch_admin/pages/account/Layout'
import AllAccount from '../../views/branch_admin/pages/account/All'
import CreateAccount from '../../views/branch_admin/pages/account/Create'
import EditAccount from '../../views/branch_admin/pages/account/Edit'
import DetailsAccount from '../../views/branch_admin/pages/account/Details'
import ImportAccount from '../../views/branch_admin/pages/account/Import'
import TransferBalance from '../../views/branch_admin/pages/account/TransferBalance'

export default {
    path: 'accounts',
    component: Layout,
    props: {
        role_permissions: ['branch_admin', 'super_admin'],
        layout_title: 'Account Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchAccount',
            component: AllAccount,
        },
        {
            path: 'import',
            name: 'AccountBalanceTransfer',
            component: TransferBalance,
        },
        {
            path: 'transfer-balance',
            name: 'AccountBalanceTransfer',
            component: ImportAccount,
        },
        {
            path: 'create',
            name: 'CreateBranchAccount',
            component: CreateAccount,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchAccount',
            component: EditAccount,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchAccount',
            component: DetailsAccount,
        },
    ],

};

