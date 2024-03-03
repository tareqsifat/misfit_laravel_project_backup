import Layout from '../../views/branch_admin/pages/subject/Layout'
import AllSubject from '../../views/branch_admin/pages/subject/All'
import CreateSubject from '../../views/branch_admin/pages/subject/Create'
import EditSubject from '../../views/branch_admin/pages/subject/Edit'
import DetailsSubject from '../../views/branch_admin/pages/subject/Details'
import ImportSubject from '../../views/branch_admin/pages/subject/Import'

export default {
    path: 'subject',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Subject Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchSubject',
            component: AllSubject,
        },
        {
            path: 'import',
            name: 'ImportBranchSubject',
            component: ImportSubject,
        },
        {
            path: 'create',
            name: 'CreateBranchSubject',
            component: CreateSubject,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchSubject',
            component: EditSubject,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchSubject',
            component: DetailsSubject,
        },
    ],

};

