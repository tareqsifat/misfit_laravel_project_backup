import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import DashboardComponent from '../components/backend/DashboardComponent'
import AdminLoginComponent from "../components/backend/auth/AdminLoginComponent";
import SliderList from "../components/backend/slider/SliderList";
import BlogList from "../components/backend/blog/BlogList";
import BlogCreate from "../components/backend/blog/BlogCreate";
import BlogEdit from "../components/backend/blog/BlogEdit";
import CompanyInfoList from "../components/backend/cinfo/CompanyInfoList";
import CompanyInfoCreate from "../components/backend/cinfo/CompanyInfoCreate";
import CompanyInfoEdit from "../components/backend/cinfo/CompanyInfoEdit";
import AttributeList from "../components/backend/attribute/AttributeList";
import SellerList from "../components/backend/seller/SellerList";
import OrderList from "../components/backend/order/OrderList";
import OrderDetails from "../components/backend/order/OrderDetails";
import CategoryList from "../components/backend/category/CategoryList";
import SaleByCategory from "../components/backend/dashboard/SaleByCategory";
import SaleByProduct from "../components/backend/dashboard/SaleByProduct";
import SaleBySeller from "../components/backend/dashboard/SaleBySeller";
import Subscribe from '../components/backend/subscribe/Subscribe';
import ShippingCharge from '../components/backend/shipping/ShippingCharge';
import OccasionList from '../components/backend/occasion/OccasionList';
import RecipientList from '../components/backend/recipient/RecipientList';
import BrandList from '../components/backend/brand/BrandList';
import ProductList from '../components/backend/product/ProductList';
import ProductEdit from '../components/backend/product/ProductEdit';
import LowstockProduct from '../components/backend/product/LowstockProduct';
import addonProduct from '../components/backend/product/addonProduct';
import editAddon from '../components/backend/product/editAddon';
import CouponList from '../components/backend/coupon/CouponList';
import CollectionList from '../components/backend/collection/CollectionList';
import CollectionSetEdit from '../components/backend/collection/CollectionSetEdit';
import PackagingList from '../components/backend/packaging/PackagingList';
import CardList from '../components/backend/card/CardList';
import CampaignUserlist from '../components/backend/users/CampaignUserlist';

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/admin/dashboard',
            component: DashboardComponent,
            name: 'adminDashboard'
        },
        {
            path: '/admin/sale-by-categories',
            component: SaleByCategory,
            name: 'saleByCategory'
        },
        {
            path: '/admin/sale-by-products',
            component: SaleByProduct,
            name: 'saleByProduct'
        },
        {
            path: '/admin/sale-by-sellers',
            component: SaleBySeller,
            name: 'saleBySeller'
        },
        {
            path: '/admin/seller-list',
            component: SellerList,
            name: 'sellerList'
        },
        {
            path: '/admin/orders',
            component: OrderList,
            name: 'orderList'
        },
        {
            path: '/admin/orders-details/:id',
            component: OrderDetails,
            name: 'orderDetails'
        },
        {
            path: '/admin/categories',
            component: CategoryList,
            name: 'categoryList'
        },
        {
            path: '/admin/brands',
            component: BrandList,
            name: 'brandList'
        },
        {
            path: '/admin/products',
            component: ProductList,
            name: 'productList',
        },
        {
            path: '/admin/addonProducts',
            component: addonProduct,
            name: 'addonProduct',
        },
        {
            path: '/admin/editAddon/:id',
            component: editAddon,
            name: 'editAddon',
        },
        {
            path: '/admin/LowstockProduct/',
            component: LowstockProduct,
            name: 'lowstockproduct',
        },
        {
            path: '/admin/collection',
            component: CollectionList,
            name: 'collectionList',
        },
        {
            path: '/admin/collection-set-edit',
            component: CollectionSetEdit,
            name: 'collectionSetEdit',
        },
        {
            path: '/admin/product-edit/:id',
            component: ProductEdit,
            name: 'editProduct',
        },
        {
            path: '/admin/occation-gifts',
            component: OccasionList,
            name: 'occasionList'
        },
        {
            path: '/admin/recipients',
            component: RecipientList,
            name: 'recipientList'
        },
        {
            path: '/admin/attributes',
            component: AttributeList,
            name: 'attributeList'
        },
        {
            path: '/admin/sliders',
            component: SliderList,
            name: 'sliderList'
        },
        {
            path: '/admin/blogs',
            component: BlogList,
            name: 'blogList'
        },
        {
            path: '/admin/blog-create',
            component: BlogCreate,
            name: 'blogCreate'
        },
        {
            path: '/admin/blog-edit/:id',
            component: BlogEdit,
            name: 'blogEdit'
        },
        {
            path: '/admin/company-infos',
            component: CompanyInfoList,
            name: 'companyInfoList'
        },
        {
            path: '/admin/company-info-create',
            component: CompanyInfoCreate,
            name: 'companyInfoCreate'
        },
        {
            path: '/admin/company-info-edit/:id',
            component: CompanyInfoEdit,
            name: 'companyInfoEdit'
        },
        {
            path: '/admin/subscribes',
            component: Subscribe,
            name: 'subscribeList'
        },
        {
            path: '/admin/shipping-charge',
            component: ShippingCharge,
            name: 'shippingChargeList'
        },
        {
            path: '/admin/coupons',
            component: CouponList,
            name: 'couponList'
        },
        {
            path: '/admin/packagings',
            component: PackagingList,
            name: 'packagingList'
        },
        {
            path: '/admin/greetings-cards',
            component: CardList,
            name: 'cardList'
        },
        {
            path: '/admin/campaign-users',
            component: CampaignUserlist,
            name: 'campaignUserlist'
        },
        {
            path: '/admin/login',
            component: AdminLoginComponent,
            name: 'adminLogin'
        },
    ]
})

//Global route guard
router.beforeEach((to, from, next) => {
    let isAuthenticated = '';
    let authUser = localStorage.getItem('adminLoggedInInfo') ? JSON.parse(localStorage.getItem('adminLoggedInInfo')) : false;
    if(authUser){
        isAuthenticated = authUser.id && authUser.email ? true : false;
    }else{
        isAuthenticated = false;
    }
    if (to.name !== 'adminLogin' && !isAuthenticated) next({ name: 'adminLogin' })
    else if(to.name === 'adminLogin' && isAuthenticated){
        next({ name: 'adminDashboard' })
    }
    else next()
})

export default router;
