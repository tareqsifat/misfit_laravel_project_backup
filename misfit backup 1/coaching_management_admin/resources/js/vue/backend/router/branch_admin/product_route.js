import Layout from '../../views/branch_admin/pages/product/Layout'
import AllProduct from '../../views/branch_admin/pages/product/All'
import CreateProduct from '../../views/branch_admin/pages/product/Create'
import EditProduct from '../../views/branch_admin/pages/product/Edit'
import DetailsProduct from '../../views/branch_admin/pages/product/Details'
import ImportProduct from '../../views/branch_admin/pages/product/Import'
import ProductOrder from '../../views/branch_admin/pages/product/ProductOrder'
import AllBranchOrders from '../../views/branch_admin/pages/product/Orders'

export default {
    path: 'product',
    component: Layout,
    props: {
        role_permissions: ['branch_admin'],
        layout_title: 'Product Management',
    },
    children: [
        {
            path: '',
            name: 'AllBranchProduct',
            component: AllProduct,
        },
        {
            path: 'import',
            name: 'ImportBranchProduct',
            component: ImportProduct,
        },
        {
            path: 'create',
            name: 'CreateBranchProduct',
            component: CreateProduct,
        },
        {
            path: 'product-order',
            name: 'CreateBranchProductOrder',
            component: ProductOrder,
        },
        {
            path: 'all-orders',
            name: 'AllBranchOrders',
            component: AllBranchOrders,
        },
        {
            path: 'edit/:id',
            name: 'EditBranchProduct',
            component: EditProduct,
        },
        {
            path: 'details/:id',
            name: 'DetailsBranchProduct',
            component: DetailsProduct,
        },
    ],

};

