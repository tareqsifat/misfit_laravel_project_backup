import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import DashboardComponent from '../components/seller/DashboardComponent'
import SellerLoginComponent from "../components/seller/auth/SellerLoginComponent";
import SellerRegisterComponent from "../components/seller/auth/SellerRegisterComponent";
import ForgotPassword from "../components/seller/auth/ForgotPassword";
import PasswordReset from "../components/seller/auth/PasswordReset";
import BrandList from "../components/seller/brand/BrandList";
import CategoryList from "../components/seller/category/CategoryList";
import ProductList from "../components/seller/product/ProductList";
import CustomerList from "../components/seller/customer/CustomerList";
import ProductCreate from "../components/seller/product/ProductCreate";
import ProductDuplicate from "../components/seller/product/ProductDuplicate";
import ProductView from "../components/seller/product/ProductView";
import AttributeList from "../components/seller/attribute/AttributeList";
import ProductEdit from "../components/seller/product/ProductEdit";
import OrderList from "../components/seller/order/OrderList";
import OrderDetails from "../components/seller/order/OrderDetails";
import ProductStock from "../components/seller/product/ProductStock";

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/seller/dashboard',
            component: DashboardComponent,
            name: 'sellerDashboard',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/login',
            component: SellerLoginComponent,
            name: 'sellerLogin',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name == 'sellerLogin' && isAuthenticated) next({ name: 'sellerDashboard' })
                else next()
            }
        },
        {
            path: '/seller/register',
            component: SellerRegisterComponent,
            name: 'sellerRegister',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name == 'sellerRegister' && isAuthenticated) next({ name: 'sellerDashboard' })
                else next()
            }
        },
        {
            path: '/seller/forgot-password',
            component: ForgotPassword,
            name: 'sellerForgotPassword'
        },
        {
            path: '/seller/reset-password/:token',
            component: PasswordReset,
            name: 'sellerPasswordReset'
        },
        {
            path: '/seller/brands',
            component: BrandList,
            name: 'brandList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/categories',
            component: CategoryList,
            name: 'categoryList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/attributes',
            component: AttributeList,
            name: 'attributeList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/products',
            component: ProductList,
            name: 'productList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/product-stock/:id',
            component: ProductStock,
            name: 'ProductStock',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/product-create',
            component: ProductCreate,
            name: 'productCreate',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/product-edit/:id',
            component: ProductEdit,
            name: 'editProduct',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/product-duplicate/:id',
            component: ProductDuplicate,
            name: 'duplicateProduct',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/product-view/:id',
            component: ProductView,
            name: 'viewProduct',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/customers',
            component: CustomerList,
            name: 'customerList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/orders',
            component: OrderList,
            name: 'orderList',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
        {
            path: '/seller/orders-details/:id',
            component: OrderDetails,
            name: 'orderDetails',
            beforeEnter: (to, from, next) => {
                let isAuthenticated = '';
                let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
                if(authUser){
                    isAuthenticated = authUser.id && authUser.email ? true : false;
                }else{
                    isAuthenticated = false;
                }
                if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
                else next()
            }
        },
    ]
})

//Global route guard
// router.beforeEach((to, from, next) => {
//     let isAuthenticated = '';
//     let authUser = localStorage.getItem('sellerLoggedInInfo') ? JSON.parse(localStorage.getItem('sellerLoggedInInfo')) : false;
//     if(authUser){
//         isAuthenticated = authUser.id && authUser.email ? true : false;
//     }else{
//         isAuthenticated = false;
//     }
//     if (to.name !== 'sellerLogin' && !isAuthenticated) next({ name: 'sellerLogin' })
//     else if(to.name === 'sellerLogin' && isAuthenticated){
//         next({ name: 'sellerDashboard' })
//     }
//     else next()
// })

export default router;
