import Layout from '../../views/branch_admin/pages/sms_history/Layout'
import AllSms from '../../views/branch_admin/pages/sms_history/All'
import CreateSms from '../../views/branch_admin/pages/sms_history/Create'
import EditSms from '../../views/branch_admin/pages/sms_history/Edit'
import DetailsSms from '../../views/branch_admin/pages/sms_history/Details'
import ImportSms from '../../views/branch_admin/pages/sms_history/Import'

export default {
    path: 'sms',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Sms Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchSms',
            component: AllSms,
        },
        {
            path: 'import',
            name: 'ImportBranchSms',
            component: ImportSms,
        },
        {
            path: 'create',
            name: 'CreateBranchSms',
            component: CreateSms,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchSms',
            component: EditSms,
        },
        
        {
            path: 'details/:id',
            name: 'DetailsBranchSms',
            component: DetailsSms,
        },
    ],

};

