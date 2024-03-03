import Layout from '../../views/admin/site_setting/Layout'
import AllSetting from '../../views/admin/site_setting/All'
import CreateSetting from '../../views/admin/site_setting/Create'
import EditSetting from '../../views/admin/site_setting/Edit'
import DetailsSetting from '../../views/admin/site_setting/Details'
import SiteLogo from '../../views/admin/site_setting/Logo'
import ImportSetting from '../../views/admin/site_setting/Import'

export default {
    path: 'site-setting',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Site Setting Management',
    },
    children: [
        {
            path: '',
            name: 'AllSetting',
            component: AllSetting,
        },
        {
            path: 'import',
            name: 'ImportSetting',
            component: ImportSetting,
        },
        {
            path: 'create',
            name: 'CreateSetting',
            component: CreateSetting,
        },
        {
            path: 'edit/:id',
            name: 'EditSetting',
            component: EditSetting,
        },
        {
            path: 'details/:id',
            name: 'DetailsSetting',
            component: DetailsSetting,
        },
        {
            path: 'logo',
            name: 'SiteLogo',
            component: SiteLogo,
        },
    ],

};

