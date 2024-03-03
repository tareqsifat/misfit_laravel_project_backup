<template>
<div id="collection_list">
    <div class="add-on-show mt-5">
        <h4 class="text-center mt-2 mb-2" v-show="lowstock_productlist">Low stock products</h4>
        <div class="row">
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">low stock prodcuts</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="lowstock_single in lowstock_productlist" :key="lowstock_single.id">
                            <th scope="row"><p>{{ lowstock_single.id }}</p></th>
                            <td><p>{{ lowstock_single.product_name }}</p></td>
                            <td>
                                <!-- <router-link class="btn btn-warning" :to="{name: 'editAddon', params: {id:lowstock_single.id}}">edit</router-link> -->
                                <router-link :to="{name: 'editProduct', params: {id:lowstock_single.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-edit"></i> Edit</router-link>
                            </td>
                            <!-- <td><button type="button" @click.prevent="deleteAddon" class="btn btn-warning">delete</button></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import $ from 'jquery'
export default {
    name: "CollectionList",
    data() {
        return {
            value: [],
            form: {
                product: '',
                addon_product: [],
            },
            length: 4,
            product: '',
            keyword: '',
            lowstock_productlist: []
        }
    },
    computed: {
        // getlowstockproduct() {
        //     return this.$store.getters['aproduct/getlowstockproduct'];
        // }
    },
    methods: {
        getlowstock() {
            axios.get('/admin/low-stock-products')
            .then((res) => {
                this.lowstock_productlist = res.data.low_stock_products
            })
        },
        // getlowstockproduct() {
        //     this.$store.dispatch('aproduct/getlowstockproduct')
        // }
    },
    created() {
        this.getlowstock()
    }


}
</script>
