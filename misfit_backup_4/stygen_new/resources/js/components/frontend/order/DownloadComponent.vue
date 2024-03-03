<template>
    <div id="download_order">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Invoice#</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total (৳)</th>
                    <th>Invoice</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="order in order_downloads.data" :key="order.id">
                    <td>{{ order.invoice_no }}</td>
                    <td>{{ order.invoice_date | timeFormat }}</td>
                    <td><span class="badge badge-success">{{ order.order_status }}</span></td>
                    <td>{{ order.total_amount }}</td>
                    <td><a class="view" href="#" @click.prevent="invoiceDownload(order.id)">Download</a></td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="product__pagination text-center">
            <el-pagination class="text-center mt-3"
               background
               @current-change="paginationChange"
               :current-page.sync="currentPage"
               :page-size="order_downloads.per_page"
               layout="prev, pager, next"
               :total="order_downloads.total">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        name: "DownloadComponent",
        data(){
            return{
                currentPage: 1
            }
        },

        computed: {
            order_downloads(){
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
            invoiceDownload(id){
                axios({
                    url: '/user/invoice-download/' +id,
                    method: 'GET',
                    responseType: 'blob',
                }).then((response) => {
                    var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                    var fileLink = document.createElement('a');

                    fileLink.href = fileURL;
                    fileLink.setAttribute('download', 'invoice-'+id+'.pdf');
                    document.body.appendChild(fileLink);

                    fileLink.click();
                });
            }
        },

        created() {
            this.user_orders();
        }
    }
</script>

<style scoped>

</style>
