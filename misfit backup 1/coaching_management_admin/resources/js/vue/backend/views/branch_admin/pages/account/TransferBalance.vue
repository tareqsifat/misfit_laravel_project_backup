<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                
                <h4>Transfer balance</h4>

                <div class="btns">
                    <router-link :to="{ name: `All${route_prefix}` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="transfer_balance($event.target)" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="admin_form form_1">

                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <label for="account_from">Select Account from</label>
                                    <select class="form-select" name="account_from" id="account_from">
                                        <option value="">Select account</option>
                                        <option v-for="item in get_all_accounts" :key="item.id" :value="item.id">{{ item.title }}</option>
                                    </select>
                                </div>
                                
                                <div class=" form-group d-grid align-content-start gap-1 mb-2 ">
                                    <label for="account_to">Select Account to</label>
                                    <select class="form-select" name="account_to" id="account_to">
                                        <option value="">Select account</option>
                                        <option v-for="item in get_all_accounts" :key="item.id" :value="item.id">{{ item.title }}</option>
                                    </select>
                                </div>


                                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                                    <input-field
                                        :label="`Amount`"
                                        :name="`amount`"
                                    />
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
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix
        }
    },
    created: function () {
        this.fetch_all_accounts()
    },
    methods: {
        ...mapActions([
            `store_${store_prefix}`,
            'fetch_all_accounts',
            'account_balance_transfer'
        ]),
        transfer_balance(event) {
            this.account_balance_transfer(event);
        },
        call_store: function(name, params=null){
            this[name](params)
        },
    },
    computed: {
        ...mapGetters([
            `get_all_accounts`,
        ]),
    }
};
</script>

<style>
</style>
