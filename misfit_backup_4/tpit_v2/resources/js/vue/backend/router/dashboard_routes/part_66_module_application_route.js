import Layout from '../../views/part_66_module_application/Layout'
import AllPart66Module from '../../views/part_66_module_application/All'
import CreatePart66Module from '../../views/part_66_module_application/Create'
import EditPart66Module from '../../views/part_66_module_application/Edit'
import DetailsPart66Module from '../../views/part_66_module_application/Details'
import ImportPart66Module from '../../views/part_66_module_application/Import'

export default {
    path: 'part-66-module-application',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Part 66 module application',
    },
    children: [{
            path: '',
            name: 'AllPart66Module',
            component: AllPart66Module,
        },
        {
            path: 'import',
            name: 'ImportPart66Module',
            component: ImportPart66Module,
        },
        {
            path: 'create',
            name: 'CreatePart66Module',
            component: CreatePart66Module,
        },
        {
            path: 'edit/:id',
            name: 'EditPart66Module',
            component: EditPart66Module,
        },
        {
            path: 'details/:id',
            name: 'DetailsPart66Module',
            component: DetailsPart66Module,
        },
    ],

};
