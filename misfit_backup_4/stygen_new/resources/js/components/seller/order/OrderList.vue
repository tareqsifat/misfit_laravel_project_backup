<template>
    <div id="order_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="card-title text-bold">Orders List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchSellerOrder" class="form-control" placeholder="Search Products..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchSellerOrder" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="orders.data" style="width: 100%">
                                        <!-- <el-table-column type="index" label="SL." width="50"></el-table-column> -->
                                        <el-table-column property="invoice_no" label="Invoice#" width="120"></el-table-column>
                                        <el-table-column label="Date" width="170">
                                            <template slot-scope="scope">{{ scope.row.created_at | orderTimeFormat }}</template>
                                        </el-table-column>

                                        <el-table-column label="Customer" width="160">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.customer">{{ scope.row.customer.customer_name }}</span>
                                            </template>
                                        </el-table-column>
                                        <!-- <el-table-column label="Customer Phone" width="130">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.customer">{{ scope.row.customer.customer_phone }}</span>
                                            </template>
                                        </el-table-column> -->

                                        <el-table-column property="total" label="Total(৳)" width="210"></el-table-column>

                                        <el-table-column label="Shipping Status" width="200">
                                            <template slot-scope="scope">
                                                    <el-select @change="changeStatus(scope.row.status, scope.row.orderID)" :ref="'status'+ scope.$index" v-model="scope.row.status" placeholder="Select" filterable >
                                                        <el-option
                                                            v-for="status in shipping_statuses"
                                                            :key="status.id"
                                                            :label="status.name"
                                                            :value="status.name">
                                                        </el-option>
                                                    </el-select>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <router-link :to="{name: 'orderDetails', params: {id:scope.row.orderID}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-zoom-in"></i>  Invoice</router-link>
                                                <button class="btn btn-outline-primary btn-sm" @click.prevent="invoiceDownload(scope.row.orderID)" title="Click to Download"><i class="el-icon-download"></i></button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import _ from 'lodash'
    export default {
        name: "OrderList",
        data() {
            return {
                currentPage: 1,
                shipping_status_id: '',
                keyword: ''
            }
        },

        methods: {
            searchSellerOrder:_.debounce(function(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('order/searchSellerOrder', payload)
            }, 1000),
            changeStatus(status, order_id){
                this.$confirm('Are you sure want to change this status. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/seller/order-status-update', {'status': status, 'order_id':order_id})
                        .then((result) => {
                            this.orderList();
                            this.$message({
                                showClose: true,
                                message: 'Status successful changed.',
                                type: 'success'
                            });
                            }).catch((error) => {

                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Status Change canceled'
                        });
                });
            },
            orderList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('order/orderList', payload)
            },
            paginationChange(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('order/orderList', payload)
            },
            invoiceDownload(id){
                axios({
                    url: '/seller/invoice-download/' +id,
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
            },
            shippingStatus(){
                this.$store.dispatch('order/shippingStatus')
            },
        },

        computed:{
            orders(){
                return this.$store.getters['order/getAllOrders'];
            },
            shipping_statuses(){
                return this.$store.getters['order/shippingStatus'];
            }
        },

        created() {
            this.orderList();
            this.shippingStatus();
        }
    }
</script>

<style scoped>

</style>
