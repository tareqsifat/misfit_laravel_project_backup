import settingLayout from '../../views/admin/settings/Layout'
import settingProfile from '../../views/admin/settings/Profile'
import settingPassword from '../../views/admin/settings/Password'

export default {
    path: 'setting',
    component: settingLayout,
    children: [{
            path: '',
            name: 'settingProfile',
            component: settingProfile,
        },
        {
            path: 'password',
            name: 'settingPassword',
            component: settingPassword,
        },
        // {
        //     path: 'details/:id',
        //     name: 'chapterDetails',
        //     component: chapterDetails,
        // },
    ],
};
