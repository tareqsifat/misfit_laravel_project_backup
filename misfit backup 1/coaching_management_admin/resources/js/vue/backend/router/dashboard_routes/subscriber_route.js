import Layout from '../../views/admin/subscriber/Layout'
import AllSubscriber from '../../views/admin/subscriber/All'
import CreateSubscriber from '../../views/admin/subscriber/Create'
import EditSubscriber from '../../views/admin/subscriber/Edit'
import DetailsSubscriber from '../../views/admin/subscriber/Details'
import ImportSubscriber from '../../views/admin/subscriber/Import'
import SendMailSubscriber from '../../views/admin/subscriber/Mail'

export default {
    path: 'subscribers',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Subscriber Management',
    },
    children: [{
            path: '',
            name: 'AllSubscriber',
            component: AllSubscriber,
        },
        {
            path: 'import',
            name: 'ImportSubscriber',
            component: ImportSubscriber,
        },
        {
            path: 'create',
            name: 'CreateSubscriber',
            component: CreateSubscriber,
        },
        {
            path: 'send_mail',
            name: 'SendMailSubscriber',
            component: SendMailSubscriber,
        },
        {
            path: 'edit/:id',
            name: 'EditSubscriber',
            component: EditSubscriber,
        },
        {
            path: 'details/:id',
            name: 'DetailsSubscriber',
            component: DetailsSubscriber,
        },
    ],

};
