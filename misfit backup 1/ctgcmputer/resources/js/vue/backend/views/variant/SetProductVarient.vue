<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Set Product Varient</h4>
                <div class="btns">
                    <router-link :to="{ name: `All${route_prefix}` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="call_store(`store_varient_products`,$event.target)" autocomplete="false" class="data_form">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group full_width d-grid align-content-start gap-1 mb-2 " >
                                    <div>
                                        <label class="mb-2 text-capitalize">
                                            Select product
                                        </label>
                                        <ProductStockManagementModal />
                                    </div>
                                </div>

                                <div v-for="varient in varients" :key="varient.id" class="form-group mb-3">
                                    <div class="mb-1">
                                        <label class="text-bold" for="">{{ varient.title }}</label>
                                    </div>
                                    <div>
                                        <select class="form-select" :name="`varients[${varient.id}][]`" @change="$event.target.dataset.chosen = $event.target.value; ">
                                            <option value="">select</option>
                                            <template v-for="value in varient.values">
                                                <option :selected="varient_ids.includes(value.id)" v-if="value.title" :value="value.id" :key="value.id">
                                                    {{ value.title }}
                                                </option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-outline-info" >
                        <i class="fa fa-upload"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
import InputField from '../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
import ProductStockManagementModal from "../product/components/ManagementModal.vue"
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField, ProductStockManagementModal },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this.fetch_all_variant_json({'orderBy': 'title'});
    },
    watch: {
        products: {
            handler: function(v){
                let selects = document.querySelectorAll('select');
                [...selects].forEach(e=>{
                    e.value='';
                    e.removeAttribute('data-chosen');
                });
                this.fetch_product_varients_id(v);
            },
            deep: true,
        },
    },
    methods: {
        ...mapMutations(['set_variant_orderByCol']),
        ...mapActions([
            'fetch_all_variant_json',
            'store_varient_products',
            'fetch_product_varients_id'
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },
    },

    computed: {
        // mapping the getters
        ...mapGetters([
            'get_customer_phone_no',
        ]),
        ...mapGetters({
            varients: 'get_all_variant_json',
            products: 'get_product_selected',
            varient_ids: 'get_product_varients_id',
        })

    },
};
</script>

<style scoped>
.invoice_email {
    margin-right: 10px !important;
}
.add_btn_email {
    margin-right: 10px !important;
}
</style>
