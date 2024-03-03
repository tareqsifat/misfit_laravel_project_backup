"use strict";(self.webpackChunk=self.webpackChunk||[]).push([[622],{1792:(e,t,r)=>{r.r(t),r.d(t,{default:()=>a});const s={name:"GiftLogin",data:function(){return{errors:{},form:{is_coupon:1}}},methods:{userRegister:function(){var e=this;axios.post("/custom_register",this.form).then((function(t){localStorage.setItem("userLoggedIn",!0),e.$router.push({name:"userDashboard"}),e.$message({showClose:!0,message:"Thank you for Registration. Check your mail for the discount coupon",type:"success"})})).catch((function(t){e.errors=t.response.data.errors}))}},watch:{$route:{handler:function(e,t){document.title="Register | Stygen"},immediate:!0}}};const a=(0,r(1900).Z)(s,(function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{attrs:{id:"user_register"}},[r("div",{staticClass:"register-area"},[r("div",{staticClass:"container register-page-main"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-md-12 col-12 col-lg-6 col-xl-6 ml-auto mr-auto"},[r("div",{staticClass:"login"},[r("div",{staticClass:"login-form-container"},[e._m(0),e._v(" "),r("div",{staticClass:"login-form"},[r("form",{attrs:{action:"#"},on:{submit:function(t){return t.preventDefault(),e.userRegister()}}},[e._m(1),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.name,expression:"form.name"}],attrs:{placeholder:"e.g. Rahim",type:"text"},domProps:{value:e.form.name},on:{input:function(t){t.target.composing||e.$set(e.form,"name",t.target.value)}}}),e._v(" "),e.errors.name?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.name[0]))]):e._e(),r("br"),e._v(" "),e._m(2),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.phone,expression:"form.phone"}],attrs:{type:"text",placeholder:"e.g. 01xxxxxxxxx"},domProps:{value:e.form.phone},on:{input:function(t){t.target.composing||e.$set(e.form,"phone",t.target.value)}}}),e._v(" "),e.errors.phone?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.phone[0]))]):e._e(),r("br"),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.is_coupon,expression:"form.is_coupon"}],attrs:{type:"hidden",value:"1"},domProps:{value:e.form.is_coupon},on:{input:function(t){t.target.composing||e.$set(e.form,"is_coupon",t.target.value)}}}),e._v(" "),e._m(3),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.email,expression:"form.email"}],attrs:{type:"email",placeholder:"e.g. example@example.com"},domProps:{value:e.form.email},on:{input:function(t){t.target.composing||e.$set(e.form,"email",t.target.value)}}}),e._v(" "),e.errors.email?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.email[0]))]):e._e(),r("br"),e._v(" "),e._m(4),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.address,expression:"form.address"}],attrs:{type:"text",placeholder:"e.g. House#1, Road#1, Flat#1A"},domProps:{value:e.form.address},on:{input:function(t){t.target.composing||e.$set(e.form,"address",t.target.value)}}}),e._v(" "),e.errors.address?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.address[0]))]):e._e(),r("br"),e._v(" "),e._m(5),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.password,expression:"form.password"}],attrs:{type:"password",placeholder:"e.g. ********"},domProps:{value:e.form.password},on:{input:function(t){t.target.composing||e.$set(e.form,"password",t.target.value)}}}),e._v(" "),e.errors.password?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.password[0]))]):e._e(),r("br"),e._v(" "),e._m(6),e._v(" "),r("input",{directives:[{name:"model",rawName:"v-model",value:e.form.password_confirmation,expression:"form.password_confirmation"}],attrs:{type:"password",placeholder:"e.g. ********"},domProps:{value:e.form.password_confirmation},on:{input:function(t){t.target.composing||e.$set(e.form,"password_confirmation",t.target.value)}}}),e._v(" "),e.errors.password_confirmation?r("span",{staticClass:"text-danger"},[e._v(e._s(e.errors.password_confirmation[0]))]):e._e(),e._v(" "),e._m(7),e._v(" "),r("p",[e._v("Already have an account? "),r("router-link",{attrs:{to:{name:"userLogin"}}},[e._v("Log in instead!")])],1)])])])])])])])])])}),[function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"container login-container"},[r("div",{staticClass:"row"},[r("div",{staticClass:"col-sm-12 col-md-12"},[r("div",{staticClass:"row text-center"},[r("h3",{staticClass:"landing-register-title-tag"},[e._v("REGISTER TO STYGEN")])])])])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Name"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Phone"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Email"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Address"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Password"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("label",[e._v("Confirm Password"),r("span",[e._v("*")])])},function(){var e=this,t=e.$createElement,r=e._self._c||t;return r("div",{staticClass:"button-box"},[r("button",{staticClass:"default-btn user-register-btn",attrs:{type:"submit"}},[e._v("Register")])])}],!1,null,"2e96bd0a",null).exports}}]);