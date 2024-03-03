<template>
    <div id="shipping_charge">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Shipping Method List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleShippingChargeDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="shippingChargeModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="shipping_charges.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="name" label="Shipping Title" width="210"></el-table-column>
                                        <el-table-column property="shipping_charge" label="Shipping Charge" width="210"></el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editShippingCharge(scope.row)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="shippingChargeDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                        background
                                        @current-change="paginationChange"
                                        :current-page.sync="currentPage"
                                        :page-size="shipping_charges.per_page"
                                        layout="prev, pager, next"
                                        :total="shipping_charges.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Shipping Charge Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Shipping Method' : 'Create Shipping Method'"
            :visible.sync="shippingChargeCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Shipping Title *">
                        <el-input v-model="form.name" placeholder="e.g. Inside Dhaka"></el-input>
                        <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Shipping Charge *">
                        <el-input type="number" v-model="form.shipping_charge" placeholder="e.g. 50"></el-input>
                        <span class="text-danger" v-if="errors['shipping_charge']">{{ errors['shipping_charge'][0] }}</span>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="shippingChargeList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createShippingCharge">Create</el-button>
                <el-button type="primary" v-else @click="updateShippingCharge">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Shipping Charge Modal End -->
    </div>
</template>

<script>
    export default {
        name: 'ShippingCharge',
        data() {
            return {
                multipleSelection: [],
                shippingChargeCreateModal: false,
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
            shippingChargeModalOpen(){
                this.shippingChargeCreateModal = true
                this.clearData();
            },
            shippingChargeList(){
                this.shippingChargeCreateModal = false
                this.$store.dispatch('shipping/shippingChargeList', this.currentPage)
            },
            shippingChargeDelete(id){
                this.$store.dispatch('shipping/shippingChargeDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Shipping charge deleted successfully.',
                    type: 'success'
                });
            },
            createShippingCharge(){
                axios.post('/admin/shippings-charge', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Shipping Charge created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.shippingChargeList();
                        this.shippingChargeCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editShippingCharge(shipping_charge){
                this.shippingChargeCreateModal = true
                this.errors = {}
                this.form = shipping_charge
            },
            updateShippingCharge(){
                axios.put('/admin/shippings-charge/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Shipping charge updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.shippingChargeList();
                        this.shippingChargeCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleShippingChargeDelete(){
                axios.post('/admin/multiple-shippings-charge-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected shipping charges deleted successfully.',
                            type: 'success'
                        });
                        this.shippingChargeList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('shipping/shippingChargeList', this.currentPage)
            }
        },

        computed:{
            shipping_charges(){
                return this.$store.getters['shipping/shippingChargeList'];
            }
        },

        created() {
            this.shippingChargeList();
        }
    }
</script>

<style scoped>

</style>
