import userRoleLayout from '../../views/admin/user_roles/Layout'
import AllRole from '../../views/admin/user_roles/All'
import CreateRole from '../../views/admin/user_roles/Create'
import EditRole from '../../views/admin/user_roles/Edit'
import DetailsRole from '../../views/admin/user_roles/Details'
import ImportRole from '../../views/admin/user_roles/Import'

export default {
    path: 'user-role',
    component: userRoleLayout,
    props: {
        role_permissions: ['super_admin'],
        layout_title: 'User Role Management',
    },
    children: [{
            path: '',
            name: 'AllRole',
            component: AllRole,
        },
        {
            path: 'import',
            name: 'ImportRole',
            component: ImportRole,
        },
        {
            path: 'create',
            name: 'CreateRole',
            component: CreateRole,
        },
        {
            path: 'edit/:id',
            name: 'EditRole',
            component: EditRole,
        },
        {
            path: 'details/:id',
            name: 'DetailsRole',
            component: DetailsRole,
        },
    ],

};
