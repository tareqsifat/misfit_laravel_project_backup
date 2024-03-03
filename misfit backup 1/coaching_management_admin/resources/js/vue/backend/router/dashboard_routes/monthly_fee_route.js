import Layout from '../../views/admin/monthly_fee/Layout'
import AllMonthlyFee from '../../views/admin/monthly_fee/All'
import DetailsMonthlyFee from '../../views/admin/monthly_fee/Details'
import ImportMonthlyFee from '../../views/admin/monthly_fee/Import'

export default {
    path: 'admin-accounts/monthly_fee',
    component: Layout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'Monthly Fee Management',
    },
    children: [
        {
            path: '',
            name: 'AllMonthlyFee',
            component: AllMonthlyFee,
        },
        {
            path: 'import',
            name: 'ImportMonthlyFee',
            component: ImportMonthlyFee,
        },
        {
            path: 'details/:id',
            name: 'DetailsMonthlyFee',
            component: DetailsMonthlyFee,
        },
    ],

};

