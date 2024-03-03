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
                                        <div class="col-md-2">
                                            <h3 class="card-title text-bold">Orders List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchAdminOrder" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchAdminOrder" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body pt-0">
                                    <div class="statusWiseOrder pt-4 pb-4 pl-1">
                                        <a href="#" @click.prevent="statusWiseFilter('')">
                                            <span v-if="statusFilter == ''" class="text-danger">All</span>
                                            <span v-else>All</span>
                                            </a> ({{ shipping_statuses.all_status }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Pending')">
                                            <span v-if="statusFilter == 'Pending'" class="text-danger">Pending</span>
                                            <span v-else>Pending</span>
                                            </a> ({{ shipping_statuses.pending }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('In Transit')">
                                            <span v-if="statusFilter == 'In Transit'" class="text-danger">In Transit</span>
                                            <span v-else>In Transit</span>
                                            </a> ({{ shipping_statuses.in_transit }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Hold')">
                                            <span v-if="statusFilter == 'Hold'" class="text-danger">Hold</span>
                                            <span v-else>Hold</span>
                                            </a> ({{ shipping_statuses.hold }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Delivered')">
                                            <span v-if="statusFilter == 'Delivered'" class="text-danger">Delivered</span>
                                            <span v-else>Delivered</span>
                                            </a> ({{ shipping_statuses.delivered }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Canceled')">
                                            <span v-if="statusFilter == 'Canceled'" class="text-danger">Canceled</span>
                                            <span v-else>Canceled</span>
                                            </a> ({{ shipping_statuses.canceled }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Returned')">
                                            <span v-if="statusFilter == 'Returned'" class="text-danger">Returned</span>
                                            <span v-else>Returned</span>
                                            </a> ({{ shipping_statuses.returned }})
                                            |
                                        <a href="#" @click.prevent="statusWiseFilter('Return to Merchant')">
                                            <span v-if="statusFilter == 'Return to Merchant'" class="text-danger">Return to Merchant</span>
                                            <span v-else>Return to Merchant</span>
                                            </a> ({{ shipping_statuses.return_to_merchant }})
                                    </div>
                                    <el-table ref="multipleTable" :data="orders.data" style="width: 100%">
                                        <!-- <el-table-column type="index" label="SL." width="50"></el-table-column> -->
                                        <el-table-column property="invoice_no" prop='invoice_no' sortable label="Invoice#" width="120"></el-table-column>
                                        <el-table-column label="Date" width="170" prop='date' sortable>
                                            <template slot-scope="scope">{{ scope.row.created_at | orderTimeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column label="Customer" width="160">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.customer">{{ scope.row.customer.customer_name }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Customer Phone" width="130">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.customer">{{ scope.row.customer.customer_phone }}</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Bkash Transaction Id" width="170" prop='date' sortable>
                                            <template slot-scope="scope">{{ scope.row.bkash_transaction }}</template>
                                        </el-table-column>
                                        <el-table-column property="total_amount" prop='total_amount' sortable label="Total(৳)" width="110"></el-table-column>
                                        <!--<el-table-column property="discount_amount" label="Discount(৳)" width="110"></el-table-column>
                                        <el-table-column property="net_receiveable_amount" label="Net Receiveable(৳)" width="210"></el-table-column>-->

                                        <el-table-column label="Payment Status" width="130">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.status && scope.row.status == 'Paid'" class="badge badge-success">Bkash paid</span>
                                                <span v-else :class="scope.row.status == 'Processing' ? 'badge badge-success':'badge badge-secondary'">{{ scope.row.status == 'Processing' ? 'Paid':'Not Paid' }}</span>
                                            </template>
                                        </el-table-column>

                                        <!-- <el-table-column label="Payment Status" width="130" prop='date'>

                                        </el-table-column> -->

                                        <el-table-column label="Shipping Status" width="150">
                                            <template slot-scope="scope">
                                                    <el-select @change="changeStatus(scope.row.shipping_status_id, scope.row.id)" :ref="'shipping_status_id'+ scope.$index" v-model="scope.row.shipping_status_id" placeholder="Select Status" filterable >
                                                        <el-option
                                                            v-for="status in shipping_statuses.shipping_statuses"
                                                            :key="status.id"
                                                            :label="status.name"
                                                            :value="status.name">
                                                        </el-option>
                                                    </el-select>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Note" width="70">
                                            <template slot-scope="scope">
                                                <button class="btn btn-outline-primary btn-sm" @click="noteCreateModalOpen(scope.row.id, scope.row.admin_note)" title="Click to Download"><i class="el-icon-notebook-1"></i></button>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <router-link :to="{name: 'orderDetails', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-zoom-in"></i>  Invoice</router-link>
                                                <!-- <a @click="invoiceDetails(scope.row.id)" class="btn btn-outline-primary btn-sm"><i class="el-icon-zoom-in"></i>  Invoice</a> -->
                                                <button class="btn btn-outline-primary btn-sm" @click.prevent="invoiceDownload(scope.row.id)" title="Click to Download"><i class="el-icon-download"></i></button>
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

                                <!-- Create Note Modal Start -->
                                    <el-dialog
                                        title= "Edit Note"
                                        :visible.sync="noteCreateModal"
                                        class="updateNoteModal">
                                        <span>
                                            <el-form>
                                                <el-form-item label="Note">
                                                    <el-input type="textarea" v-model="note" placeholder="e.g. "></el-input>
                                                </el-form-item>
                                            </el-form>
                                        </span>
                                        <span slot="footer" class="dialog-footer">
                                            <el-button @click="noteModalCancel">Cancel</el-button>
                                            <el-button type="primary" @click="updateNote">Update</el-button>
                                        </span>
                                    </el-dialog>
                                    <!-- Create Note Modal End -->
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
                keyword: '',
                statusFilter : '',
                order_id : '',
                note : '',
                noteCreateModal : false
            }
        },

        methods: {
            // invoiceDetails(order_id){
            //     this.$router.push({name: 'orderDetails', params: {'id': order_id}, query: { 'keyword': this.statusFilter}})
            // },
            noteCreateModalOpen(OrderID, Note){
                this.noteCreateModal = true
                this.order_id = OrderID
                this.note = Note
                // this.clearData();
            },
            noteModalCancel(){
                this.noteCreateModal = false
                this.orderList()
                // let payload = {'page': this.currentPage, 'keyword': this.keyword}
                // this.$store.dispatch('aorder/orderList', payload)
            },
            updateNote() {
                const formData = new FormData();
                formData.append("order_id", this.order_id);
                formData.append("note", this.note);
                axios.post('/admin/order-note-update', formData)
                    .then((result) => {
                        this.orderList();
                        this.order_id = ''
                        this.note = ''
                        this.noteCreateModal = false
                        this.$message({
                            showClose: true,
                            message: 'Note updated successfully.',
                            type: 'success'
                        });
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            statusWiseFilter(Status) {
                this.keyword = ''
                this.statusFilter = Status
                let payload = {'page': this.currentPage, 'keyword': this.statusFilter}
                this.$store.dispatch('aorder/orderList', payload)
            },
            searchAdminOrder:_.debounce(function(){
                this.statusFilter = ''
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('aorder/searchAdminOrder', payload)
            }, 1000),
            orderList(){
                // this.$route.query.keyword
                if(this.statusFilter != '') {
                    var key_word = this.statusFilter
                } else {
                    var key_word = this.keyword
                }
                let payload = {'page': this.currentPage, 'keyword': key_word}
                this.$store.dispatch('aorder/orderList', payload)
            },
            paginationChange(){
                if(this.statusFilter != '') {
                    var key_word = this.statusFilter
                } else {
                    var key_word = this.keyword
                }
                // let payload = {'page': this.currentPage, 'keyword': this.keyword}
                let payload = {'page': this.currentPage, 'keyword': key_word}
                this.$store.dispatch('aorder/orderList', payload)
            },
            changeStatus(status, order_id){
                this.$confirm('Are you sure want to change this status. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/admin/order-status-update', {'status': status, 'order_id':order_id})
                        .then((result) => {
                            this.orderList();
                            this.shippingStatus();
                            this.$message({
                                showClose: true,
                                message: 'Status successful updated.',
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
            invoiceDownload(id){
                axios({
                    url: '/admin/admin-invoice-download/' +id,
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
                this.$store.dispatch('aorder/shippingStatus')
            },
        },

        computed:{
            orders(){
                return this.$store.getters['aorder/getAllOrders'];
            },
            shipping_statuses(){
                return this.$store.getters['aorder/shippingStatus'];
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
