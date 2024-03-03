<template>
    <div id="customer_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Customers List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleCustomerDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="customerModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="customers.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="customer_name" label="Name" width="210"></el-table-column>
                                        <el-table-column property="customer_email" label="Email" width="210"></el-table-column>
                                        <el-table-column property="customer_phone" label="Phone" width="210"></el-table-column>
                                        <el-table-column property="customer_address" label="Address" width="310"></el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editCustomer(scope.row)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="customerDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                                   background
                                                   @current-change="paginationChange"
                                                   :current-page.sync="currentPage"
                                                   :page-size="customers.per_page"
                                                   layout="prev, pager, next"
                                                   :total="customers.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Customer Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Customer' : 'Create Customer'"
            :visible.sync="customerCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Name *">
                        <el-input v-model="form.customer_name" placeholder="e.g. Rahim"></el-input>
                        <span class="text-danger" v-if="errors['customer_name']">{{ errors['customer_name'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Email">
                        <el-input v-model="form.customer_email" placeholder="e.g. rahim@example.com"></el-input>
                    </el-form-item>

                    <el-form-item label="Phone *">
                        <el-input v-model="form.customer_phone" placeholder="e.g. 01xxxxxxxxx"></el-input>
                        <span class="text-danger" v-if="errors['customer_phone']">{{ errors['customer_phone'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Address">
                        <el-input type="textarea" v-model="form.customer_address" placeholder="e.g. Dhaka"></el-input>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="customerList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createCustomer">Create</el-button>
                <el-button type="primary" v-else @click="updateCustomer">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Customer Modal End -->
    </div>
</template>

<script>
    export default {
        name: "CustomerList",
        data() {
            return {
                multipleSelection: [],
                customerCreateModal: false,
                form: {},
                errors: {},
                currentPage: 1,
            }
        },

        methods: {
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            clearData(){
                this.errors = {}
                this.form = {}
            },
            customerModalOpen(){
                this.customerCreateModal = true
                this.clearData();
            },
            customerList(){
                this.customerCreateModal = false
                this.$store.dispatch('customer/customerList', this.currentPage)
            },
            customerDelete(id){
                this.$store.dispatch('customer/customerDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Customer deleted successfully.',
                    type: 'success'
                });
            },
            createCustomer(){
                axios.post('/seller/customer', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Customer created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.customerList();
                        this.customerCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editCustomer(customer){
                this.customerCreateModal = true
                this.errors = {}
                this.form = customer
            },
            updateCustomer(){
                axios.put('/seller/customer/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Customer updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.customerList();
                        this.customerCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleCustomerDelete(){
                axios.post('/seller/multiple-customer-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected customers deleted successfully.',
                            type: 'success'
                        });
                        this.customerList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('customer/customerList', this.currentPage)
            }
        },

        computed:{
            customers(){
                return this.$store.getters['customer/getAllCustomers'];
            }
        },

        created() {
            this.customerList();
        }
    }
</script>

<style scoped>

</style>
