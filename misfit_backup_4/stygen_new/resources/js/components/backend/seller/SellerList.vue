<template>
    <div id="seller_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Seller List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleSellerApprove">Approve All</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="sellers.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="120">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column label="Status" width="80">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.status == 1"  class="badge badge-success">Approved</span>
                                                <span v-else class="badge badge-danger">Pending</span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column property="name" label="Name" width="120"></el-table-column>
                                        <el-table-column property="phone" label="Phone" width="120"></el-table-column>
                                        <el-table-column property="email" label="Email" width="120"></el-table-column>
                                        <el-table-column label="NID" width="110">
                                            <template slot-scope="scope">
                                                <img v-if="scope.row.nid" :src="`/assets/uploads/seller_doc/${scope.row.nid}`" width='110' height='110' alt="Not Found">
                                                <img v-else src="/assets/uploads/seller_doc/seller_placeholder.png" width='110' height='110' alt="Not Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="TIN" width="110">
                                            <template slot-scope="scope">
                                                <img v-if="scope.row.tin" :src="`/assets/uploads/seller_doc/${scope.row.tin}`" width='110' height='110' alt="Not Found">
                                                <img v-else src="/assets/uploads/seller_doc/seller_placeholder.png" width='110' height='110' alt="Not Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="BIN" width="110">
                                            <template slot-scope="scope">
                                                <img v-if="scope.row.bin" :src="`/assets/uploads/seller_doc/${scope.row.bin}`" width='110' height='110' alt="Not Found">
                                                <img v-else src="/assets/uploads/seller_doc/seller_placeholder.png" width='110' height='110' alt="Not Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button v-if="scope.row.status == 0" size="mini" type="danger" @click.prevent="adminSellerApprove(scope.row.id)">Approve</el-button>
                                                <el-button v-else size="mini" type="success">Approved</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="sellers.per_page"
                                       layout="prev, pager, next"
                                       :total="sellers.total">
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
    export default {
        name: "SellerList",
        data() {
            return {
                multipleSelection: [],
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
            adminSellerList(){
                this.$store.dispatch('seller/adminSellerList', this.currentPage)
            },
            adminSellerApprove(id){
                this.$confirm('Are you sure approve this seller. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/admin/seller-approve', {'id':id})
                            .then((result) => {
                                this.$message({
                                    showClose: true,
                                    message: 'Seller approved successfully.',
                                    type: 'success'
                                });
                                this.adminSellerList();
                            }).catch((error) => {

                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Approval canceled'
                        });
                });
            },
            multipleSellerApprove(){
                this.$confirm('Are you sure approve all sellers. Continue?', 'Warning', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                    }).then(() => {
                        axios.post('/admin/multiple-seller-approve', this.multipleSelection)
                            .then((result) => {
                                this.$message({
                                    showClose: true,
                                    message: 'Selected sellers approved successfully.',
                                    type: 'success'
                                });
                                this.adminSellerList();
                            }).catch((error) => {

                        });
                    }).catch(() => {
                        this.$message({
                            type: 'info',
                            message: 'Approval canceled'
                        });
                });
            },
            paginationChange(){
                this.$store.dispatch('seller/adminSellerList', this.currentPage)
            }
        },

        computed:{
            sellers(){
                return this.$store.getters['seller/adminSellerList'];
            }
        },

        created() {
            this.adminSellerList();
        }
    }
</script>

<style scoped>

</style>
