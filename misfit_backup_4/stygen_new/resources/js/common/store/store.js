//Vuex Support-------------------
import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)
//Vuex Support-------------------

import {user} from './modules/user'
import {seller} from './modules/seller'
import {admin} from './modules/admin'
import {category} from './modules/category'
import {acategory} from './modules/acategory'
import {brand} from './modules/brand'
import {abrand} from './modules/abrand'
import {customer} from './modules/customer'
import {product} from './modules/product'
import {aproduct} from './modules/aproduct'
import {attribute} from './modules/attribute'
import {adattribute} from './modules/adattribute'
import {sattribute} from './modules/sattribute'
import {wishlist} from './modules/wishlist'
import {cart} from './modules/cart'
import {order} from './modules/order'
import {aorder} from './modules/aorder'
import {material} from "./modules/material";
import {slider} from './modules/slider'
import {blog} from './modules/blog'
import {cinfo} from './modules/cinfo'
import {dashboard} from './modules/dashboard'
import {shipping} from './modules/shipping'
import {ashipping} from './modules/ashipping'
import {occasion} from './modules/occasion'
import {recipient} from './modules/recipient'
import {coupon} from './modules/coupon'
import {aseller} from './modules/aseller'
import {aoccasion} from './modules/aoccasion'
import {packaging} from './modules/packaging'
import {card} from './modules/card'

export const store = new Vuex.Store({
    modules: {
        user: user,
        seller: seller,
        admin: admin,
        category: category,
        acategory: acategory,
        brand: brand,
        abrand: abrand,
        customer: customer,
        product: product,
        aproduct: aproduct,
        attribute: attribute,
        adattribute: adattribute,
        sattribute: sattribute,
        wishlist: wishlist,
        cart: cart,
        order: order,
        aorder: aorder,
        material: material,
        slider: slider,
        blog: blog,
        cinfo: cinfo,
        dashboard: dashboard,
        shipping: shipping,
        ashipping: ashipping,
        occasion: occasion,
        recipient: recipient,
        coupon: coupon,
        aseller: aseller,
        aoccasion: aoccasion,
        packaging: packaging,
        card: card
    }
})
