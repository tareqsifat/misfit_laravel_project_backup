<template>
    <div id="coupon_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold mb-5">Coupon List</h3>
                                    <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchCoupon" class="form-control" placeholder="Search..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchCoupon" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleCouponDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="couponModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="coupons.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <!-- <el-table-column label="Start Date" width="150">
                                            <template slot-scope="scope">{{ scope.row.start_date | timeFormat }}</template>
                                        </el-table-column> -->
                                        <el-table-column label="Expire Date" width="150">
                                            <template slot-scope="scope">{{ scope.row.expire_date | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="code" label="Code" width="110"></el-table-column>
                                        <el-table-column property="use_limit" label="Use Limit" width="110"></el-table-column>
                                        <el-table-column property="amount" label="Amount" width="110"></el-table-column>
                                        <el-table-column property="minimum_spent" label="Min Spent" width="110"></el-table-column>
                                        <el-table-column property="maximum_spent" label="Max Spent" width="110"></el-table-column>
                                        <el-table-column label="Discount Type" width="150">
                                            <template slot-scope="scope">
                                                <span class="badge badge-success">{{ scope.row.discount_type }}</span>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Coupon Status" width="150">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.coupon_spent == 1" class="badge badge-success">Used</span>
                                                <span v-else class="badge badge-primary">Not Used</span>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Coupon Spent at" width="150">
                                            <template  slot-scope="scope">{{ scope.row.spent_at | timeFormat }}</template>
                                        </el-table-column>

                                        <el-table-column property="users.name" label="Coupon User" width="110"></el-table-column>
                                        <el-table-column property="users.phone" label="Phone" width="110"></el-table-column>

                                        <!-- <el-table-column label="Coupon User name" width="150">
                                            <template  slot-scope="scope">{{ scope.row.users.id }}</template>
                                        </el-table-column> -->


                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editCoupon(scope.row)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="couponDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                        background
                                        @current-change="paginationChange"
                                        :current-page.sync="currentPage"
                                        :page-size="coupons.per_page"
                                        layout="prev, pager, next"
                                        :total="coupons.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Coupon Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Coupon' : 'Create Coupon'"
            :visible.sync="couponCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-row :gutter="20">
                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Title">
                                <el-input v-model="form.title" placeholder="e.g. Eid"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Coupon Code *">
                                <el-input type="text" v-model="form.code" placeholder="e.g. eid100"></el-input>
                                <span class="text-danger" v-if="errors['code']">{{ errors['code'][0] }}</span>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Start Date *">
                                <el-input type="date" v-model="form.start_date"></el-input>
                                <span class="text-danger" v-if="errors['start_date']">{{ errors['start_date'][0] }}</span>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Expire Date *">
                                <el-input type="date" v-model="form.expire_date"></el-input>
                                <span class="text-danger" v-if="errors['expire_date']">{{ errors['expire_date'][0] }}</span>
                            </el-form-item>
                        </el-col>
                    </el-row>

                     <el-row :gutter="20">
                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Minimum Spent *">
                                <el-input type="number" v-model="form.minimum_spent" placeholder="e.g. 1"></el-input>
                                <span class="text-danger" v-if="errors['minimum_spent']">{{ errors['minimum_spent'][0] }}</span>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="24" :sm="24" :md="12" :lg="12" :xl="12">
                            <el-form-item label="Maximum Spent *">
                                <el-input type="number" v-model="form.maximum_spent" placeholder="e.g. 10"></el-input>
                                <span class="text-danger" v-if="errors['maximum_spent']">{{ errors['maximum_spent'][0] }}</span>
                            </el-form-item>
                        </el-col>
                    </el-row>

                    <el-row :gutter="20">
                        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8">
                            <el-form-item label="Use Limit *">
                                <el-input type="number" v-model="form.use_limit" placeholder="e.g. 1"></el-input>
                                <span class="text-danger" v-if="errors['use_limit']">{{ errors['use_limit'][0] }}</span>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8">
                            <el-form-item label="Amount *">
                                <el-input type="number" v-model="form.amount" placeholder="e.g. 10"></el-input>
                                <span class="text-danger" v-if="errors['amount']">{{ errors['amount'][0] }}</span>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="24" :sm="24" :md="8" :lg="8" :xl="8">
                            <el-form-item label="Discount Type *">
                                <el-select v-model="form.discount_type" placeholder="Select Discount Type">
                                    <el-option label="Fixed" value="Fixed"></el-option>
                                    <el-option label="Percentage" value="Percentage"></el-option>
                                </el-select>
                                <span class="text-danger" v-if="errors['discount_type']">{{ errors['discount_type'][0] }}</span>
                            </el-form-item>
                        </el-col>
                    </el-row>

                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="couponList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createCoupon">Create</el-button>
                <el-button type="primary" v-else @click="updateCoupon">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Coupon Modal End -->
    </div>
</template>

<script>
    export default {
        name: 'CouponList',
        data() {
            return {
                multipleSelection: [],
                couponCreateModal: false,
                form: {},
                errors: {},
                coupon_users: [],
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
            couponModalOpen(){
                this.couponCreateModal = true
                this.clearData();
            },
            couponList(){
                this.couponCreateModal = false
                this.$store.dispatch('coupon/couponList', this.currentPage)
            },
            couponDelete(id){
                this.$store.dispatch('coupon/couponDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Coupon deleted successfully.',
                    type: 'success'
                });
            },
            searchCoupon:_.debounce(function(){
                this.statusFilter = ''
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('coupon/searchCoupon', payload)
            }, 1000),
            couponUsers() {
                axios.get('/admin/coupon_user_list')
                .then((res) => {
                    this.coupon_users = res.data.coupon_users
                    console.log(this.coupon_users);
                })
            },
            createCoupon(){
                axios.post('/admin/coupon', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Coupon created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.couponList();
                        this.couponCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editCoupon(coupon){
                this.couponCreateModal = true
                this.errors = {}
                this.form = coupon
            },
            updateCoupon(){
                axios.put('/admin/coupon/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Coupon updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.couponList();
                        this.couponCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleCouponDelete(){
                axios.post('/admin/multiple-coupon-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected coupon deleted successfully.',
                            type: 'success'
                        });
                        this.couponList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('coupon/couponList', this.currentPage)
            }
        },

        computed:{
            coupons(){
                return this.$store.getters['coupon/couponList'];
            }
        },

        created() {
            this.couponList();
            this.couponUsers();
        }
    }
</script>

<style scoped>

</style>
