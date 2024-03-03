<template>
    <div id="orders">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Invoice#</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total (৳)</th>
                    <!--<th>Actions</th>-->
                </tr>
                </thead>
                <tbody>
                <tr v-for="order in orders.data" :key="order.id">
                    <td>{{ order.invoice_no }}</td>
                    <td>{{ order.invoice_date | timeFormat }}</td>
                    <td><span class="badge badge-success">{{ order.order_status }}</span></td>
                    <td>{{ order.total_amount }}</td>
                    <!--<td><a class="view" href="#">INVOICE</a></td>-->
                </tr>
                </tbody>
            </table>
        </div>
        <div class="product__pagination text-center">
            <el-pagination class="text-center mt-3"
               background
               @current-change="paginationChange"
               :current-page.sync="currentPage"
               :page-size="orders.per_page"
               layout="prev, pager, next"
               :total="orders.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "OrdersComponent",
        data(){
            return{
                currentPage: 1
            }
        },

        computed: {
            user(){
                return this.$store.getters['user/getUserDetails']
            },
            orders(){
                return this.$store.getters['order/user_orders']
            },
        },

        methods: {
            user_orders(){
                this.$store.dispatch('order/user_orders', this.currentPage);
            },
            paginationChange(){
                this.$store.dispatch('order/user_orders', this.currentPage)
            },
            getUser(){
                this.$store.dispatch('user/getUser');
            },
            userLogout(){
                this.$store.dispatch('user/userLogout');
                localStorage.removeItem('userLoggedIn');
                this.$router.push({name: 'landing'})
                this.$message({
                    message: 'You have logged out.',
                    type: 'success'
                });
            }
        },

        created() {
            this.getUser();
            this.user_orders();
        }
    }
</script>

<style scoped>

</style>
