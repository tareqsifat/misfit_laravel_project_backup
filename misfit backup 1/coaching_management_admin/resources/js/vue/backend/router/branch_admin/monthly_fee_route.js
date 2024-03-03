import Layout from '../../views/branch_admin/pages/monthly_fee/Layout'
import AllMonthlyFee from '../../views/branch_admin/pages/monthly_fee/All'
import CreateMonthlyFee from '../../views/branch_admin/pages/monthly_fee/Create'
import EditMonthlyFee from '../../views/branch_admin/pages/monthly_fee/Edit'
import DetailsMonthlyFee from '../../views/branch_admin/pages/monthly_fee/Details'
import ImportMonthlyFee from '../../views/branch_admin/pages/monthly_fee/Import'

export default {
    path: 'accounts/monthly_fee',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Monthly Fee Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchMonthlyFee',
            component: AllMonthlyFee,
        },
        {
            path: 'import',
            name: 'ImportBranchMonthlyFee',
            component: ImportMonthlyFee,
        },
        {
            path: 'create',
            name: 'CreateBranchMonthlyFee',
            component: CreateMonthlyFee,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchMonthlyFee',
            component: EditMonthlyFee,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchMonthlyFee',
            component: DetailsMonthlyFee,
        },
    ],

};

