import Layout from '../../views/admin/product/Layout'
import AllProduct from '../../views/admin/product/All'
import CreateProduct from '../../views/admin/product/Create'
import EditProduct from '../../views/admin/product/Edit'
import DetailsProduct from '../../views/admin/product/Details'
import ImportProduct from '../../views/admin/product/Import'
import StockProduct from '../../views/admin/product/StockProduct'

export default {
    path: 'product',
    component: Layout,
    props: {
        role_permissions: ['super_admin','admin'],
        layout_title: 'Product Management',
    },
    children: [
        {
            path: '',
            name: 'AllProduct',
            component: AllProduct,
        },
        {
            path: 'import',
            name: 'ImportProduct',
            component: ImportProduct,
        },
        {
            path: 'create',
            name: 'CreateProduct',
            component: CreateProduct,
        },
        {
            path: 'edit/:id',
            name: 'EditProduct',
            component: EditProduct,
        },
        {
            path: 'details/:id',
            name: 'DetailsProduct',
            component: DetailsProduct,
        },
        {
            path: 'stock/:id',
            name: 'StockProduct',
            component: StockProduct,
        },
    ],

};

