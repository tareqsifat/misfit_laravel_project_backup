"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[875],{3965:(t,a,n)=>{n.r(a),n.d(a,{default:()=>i});const e={name:"WarrantyComponent",methods:{getLandingCompanyInfo:function(){this.$store.dispatch("cinfo/getLandingCompanyInfo")}},computed:{companyInfo:function(){return this.$store.getters["cinfo/getLandingCompanyInfo"]}},created:function(){this.getLandingCompanyInfo()},watch:{$route:{handler:function(t,a){document.title="Warranty Guide | Stygen"},immediate:!0}}};const i=(0,n(1900).Z)(e,(function(){var t=this,a=t.$createElement,n=t._self._c||a;return n("div",{attrs:{id:"warranty"}},[n("div",{staticClass:"breadcrumb-area"},[n("div",{staticClass:"container"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-12"},[n("div",{staticClass:"breadcrumb-content text-center"},[n("ul",[n("li",[n("router-link",{attrs:{to:{name:"landing"}}},[t._v("Home")])],1),t._v(" "),n("li",{staticClass:"active"},[t._v("Warranty Guide")])])])])])])]),t._v(" "),n("div",{staticClass:"Shopping-cart-area mt-4"},[n("div",{staticClass:"container"},[n("div",{staticClass:"row"},[n("div",{staticClass:"col-12"},[n("h3",[t._v("Warranty Guide:")]),t._v(" "),n("p",{domProps:{innerHTML:t._s(t.companyInfo.warranty_guide)}})])])])])])}),[],!1,null,"655f4b28",null).exports}}]);