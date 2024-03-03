import Vue from 'vue'
import VueRouter from 'vue-router'
import VueMeta from 'vue-meta'

Vue.use(VueRouter)
Vue.use(VueMeta)

const router = new VueRouter({
    scrollBehavior() {
        return {
            x: 0, y: 0,
            behavior: 'smooth',
        };
    },
    mode: 'history',
    linkActiveClass: 'active',
    routes: [
        {
            path: '/',
            name: 'landing',
            component: ()=> import (/* webpackChunkName: "Landing" */ '../components/frontend/LandingComponent'),
            meta: { title: 'Best online Gift Shop in Bangladesh | Stygen' }
        },
        {
            path: '/seller',
            name: 'sellerPage',
            component: ()=> import(/* webpackChunkName: "SellerPage" */ '../components/frontend/SellerComponent'),
        },
        {
            path: '/seller-term-and-condition',
            name: 'sellerTermandCondition',
            component: ()=> import(/* webpackChunkName: "Seller-terms-condition" */ '../components/frontend/SellerTermCondition'),

        },
        {
            path: '/warranty-guide',
            name: 'warrantyGuide',
            component: ()=>import(/* webpackChunkName: "WarrantyComponent" */ '../components/frontend/WarrantyComponent'),
        },
        {
            path: '/return-policy',
            name: 'returnPolicy',
            component: ()=>import(/* webpackChunkName: "ReturnPolicyComponent" */ '../components/frontend/ReturnPolicyComponent'),
        },
        {
            path: '/about-us',
            name: 'aboutUs',
            component: ()=>import(/* webpackChunkName: "AboutComponent" */ '../components/frontend/AboutComponent'),
        },
        {
            path: '/privacy-policy',
            name: 'privacyPolicy',
            component: ()=>import(/* webpackChunkName: "PrivacyPolicy" */ '../components/frontend/PrivacyPolicy'),
        },
        {
            path: '/terms-and-condition',
            name: 'termsCondition',
            component: ()=>import(/* webpackChunkName: "TermsCondition" */ '../components/frontend/TermsCondition'),
        },

        {
            path: '/contact-us',
            name: 'contactUs',
            component: ()=>import(/* webpackChunkName: "ContactUs" */ '../components/frontend/ContactUs'),
        },
        {
            path: '/junior-project-2021',
            name: 'juniorProject',
            component: ()=>import(/* webpackChunkName: "ContactUs" */ '../components/frontend/juniorProject'),
        },
        {
            path: '/blog',
            name: 'blog',
            component: ()=>import(/* webpackChunkName: "BlogComponent" */ '../components/frontend/blog/BlogComponent'),
        },
        {
            path: '/blog/:blogSlug',
            name: 'singleBlog',
            component: ()=>import(/* webpackChunkName: "SingleBlogComponent" */ '../components/frontend/blog/SingleBlogComponent'),
        },
        {
            path: '/search',
            name: 'searchProduct',
            component: ()=>import(/* webpackChunkName: "SearchProduct" */ '../components/frontend/search/SearchProduct'),
            props: (route) => ({keyword: route.query.keyword})

        },
        {
            path: '/searching',
            name: 'searching',
            component: ()=>import(/* webpackChunkName: "Searching" */ '../components/frontend/search/Searching'),
        },
        {
            path: '/shop',
            name: 'shop',
            component: ()=>import(/* webpackChunkName: "ShopComponent" */ '../components/frontend/product/ShopComponent'),
            meta: { title: 'Shop | Stygen' }
        },
        {
            path: '/product/:slug',
            name: 'singleProduct',
            component: ()=>import(/* webpackChunkName: "SingleProductComponent" */ '../components/frontend/product/SingleProductComponent'),
        },
        {
            path: '/product-category/:catSlug',
            name: 'subCategoryProduct',
            component: ()=>import(/* webpackChunkName: "SubCategoryProduct" */ '../components/frontend/product/SubCategoryProduct'),
        },
        {
            path: '/gift-by-occasion/:occasionSlug',
            name: 'occasionProduct',
            component: ()=>import(/* webpackChunkName: "OccasionProduct" */ '../components/frontend/product/OccasionProduct'),

        },
        {
            path: '/brand/:brandSlug',
            name: 'brandProductList',
            component: ()=>import(/* webpackChunkName: "BrandProductList" */ '../components/frontend/product/BrandProductList'),
        },
        {
            path: '/cart',
            name: 'cartView',
            component: ()=>import(/* webpackChunkName: "CartComponent" */ '../components/frontend/cart/CartComponent'),
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: ()=>import(/* webpackChunkName: "CheckoutComponent" */ '../components/frontend/checkout/CheckoutComponent'),
        },
        {
            path: '/new-year-gift',
            name: 'couponGame',
            component: ()=>import(/* webpackChunkName: "CouponGame" */ '../components/frontend/Games/CouponGame'),
        },
        {
            path: '/thank-you',
            name: 'thankYou',
            component: ()=>import(/* webpackChunkName: "ThankYou" */ '../components/frontend/checkout/ThankYou'),
        },
        {
            path: '/payment-failed',
            name: 'paymentFailed',
            component: ()=>import(/* webpackChunkName: "PaymentFailed" */ '../components/frontend/checkout/PaymentFailed'),
        },
        {
            path: '/orders',
            name: 'orders',
            component: ()=>import(/* webpackChunkName: "OrdersComponent" */ '../components/frontend/order/OrdersComponent'),
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name !== 'userLogin' && !isAuthenticated) next({ name: 'userLogin' })
                else next()
            }
        },
        {
            path: '/wishlist',
            name: 'wishlist',
            component: ()=>import(/* webpackChunkName: "WishlistComponent" */ '../components/frontend/wishlist/WishlistComponent'),
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name !== 'userLogin' && !isAuthenticated) next({ name: 'userLogin' })
                else next()
            }
        },
        {
            path: '/otp-login',
            name: 'otpLogin',
            component: ()=>import(/* webpackChunkName: "OTPLogin" */ '../components/frontend/checkout/OTPLogin'),
        },
        {
            path: '/campaign-registration/',
            name: 'GiftLogin',
            component: ()=>import(/* webpackChunkName: "GiftLogin" */ '../components/frontend/auth/GiftLogin'),

            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name == 'userRegister' && isAuthenticated) next({ name: 'userDashboard' })
                else next()
            }
        },
        {
            path: '/shop-registration/',
            name: 'GiftLogin',
            component: ()=>import(/* webpackChunkName: "shoplogin" */ '../components/frontend/auth/GiftLogin'),

            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name == 'userRegister' && isAuthenticated) next({ name: 'userDashboard' })
                else next()
            }
        },

        {
            path: '/login',
            name: 'userLogin',
            component: ()=> import(/* webpackChunkName: "userLogin" */ '../components/frontend/auth/UserLoginComponent'),
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name == 'userLogin' && isAuthenticated) next({ name: 'userDashboard' })
                else next()
            }
        },
        {
            path: '/register',
            name: 'userRegister',
            component: ()=> import(/* webpackChunkName: "UserRegisterComponent" */ '../components/frontend/auth/UserRegisterComponent'),
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name == 'userRegister' && isAuthenticated) next({ name: 'userDashboard' })
                else next()
            }
        },
        {
            path: '/forgot-password',
            name: 'userForgotPassword',
            component: ()=> import(/* webpackChunkName: "userForgotPassword" */ '../components/frontend/auth/ForgotPassword'),
        },
        {
            path: '/reset-password/:token',
            name: 'userPasswordReset',
            component: ()=> import(/* webpackChunkName: "userPasswordReset" */ '../components/frontend/auth/PasswordReset'),
        },
        {
            path: '/user/dashboard',
            name: 'userDashboard',
            component: ()=> import(/* webpackChunkName: "UserDashboardComponent" */ '../components/frontend/user/UserDashboardComponent'),
            beforeEnter: (to, from, next) => {
                const isAuthenticated = localStorage.getItem('userLoggedIn') ? true : false;
                if (to.name !== 'userLogin' && !isAuthenticated) next({ name: 'userLogin' })
                else next()
            }
        },
    ]
})

export default router;
