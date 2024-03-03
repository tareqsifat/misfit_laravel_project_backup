import Layout from '../../views/branch_admin/pages/batch/Layout'
import AllBatch from '../../views/branch_admin/pages/batch/All'
import CreateBatch from '../../views/branch_admin/pages/batch/Create'
import EditBatch from '../../views/branch_admin/pages/batch/Edit'
import DetailsBatch from '../../views/branch_admin/pages/batch/Details'
import ImportBatch from '../../views/branch_admin/pages/batch/Import'
import AddSubject from '../../views/branch_admin/pages/subject/Create'
import BatchNotification from '../../views/branch_admin/pages/notification/BatchNotification'
import BatchSms from '../../views/branch_admin/pages/sms_history/BatchSms'

export default {
    path: 'batch',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Batch Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchBatch',
            component: AllBatch,
        },
        {
            path: 'import',
            name: 'ImportBranchBatch',
            component: ImportBatch,
        },
        {
            path: 'create',
            name: 'CreateBranchBatch',
            component: CreateBatch,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchBatch',
            component: EditBatch,
        },
        {
            path: 'subjects/:id',
            name: 'AddBranchBatchSubject',
            component: AddSubject,
        },
        {
            path: 'notifications/:id',
            name: 'AddBranchBatchNotification',
            component: BatchNotification,
        },
        {
            path: 'sms/:id',
            name: 'AddBranchBatchSms',
            component: BatchSms,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchBatch',
            component: DetailsBatch,
        },
    ],

};

