<template>
    <div id="brand_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Brands List</h3>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="brands.data" style="width: 100%">
                                        <el-table-column label="SL." type="index" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="brand_name" label="Name" width="210"></el-table-column>
                                        <el-table-column property="brand_website" label="Brand Website" width="210"></el-table-column>
                                        <el-table-column label="Status" width="120">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.approve == 1"><span class="badge badge-success">Approved</span></span>
                                                <span v-else><span class="badge badge-danger">Approval Pending</span></span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editBrand(scope.row)">Edit</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="brands.per_page"
                                       layout="prev, pager, next"
                                       :total="brands.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Brand Modal Start -->
        <el-dialog
            title= "Edit Brand"
            :visible.sync="brandCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Name *">
                        <el-input v-model="form.brand_name" placeholder="e.g. Stygen"></el-input>
                        <span class="text-danger" v-if="errors['brand_name']">{{ errors['brand_name'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Website URL *">
                        <el-input v-model="form.brand_website" placeholder="e.g. www.yellow.com"></el-input>
                        <span class="text-danger" v-if="errors['brand_website']">{{ errors['brand_website'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Description">
                        <el-input type="textarea" v-model="form.brand_description" placeholder="e.g. Description"></el-input>
                    </el-form-item>

                    <el-checkbox-group v-model="form.approve">
                        <el-checkbox label="Approve Brand"></el-checkbox>
                    </el-checkbox-group>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="brandList">Cancel</el-button>
                <el-button type="primary" @click="updateBrand">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Category Modal End -->
    </div>
</template>

<script>
    export default {
        name: "BrandList",
        data() {
            return {
                multipleSelection: [],
                brandCreateModal: false,
                form: {},
                errors: {},
                currentPage: 1,
            }
        },

        methods: {
            clearData(){
                this.errors = {}
                this.form = {}
            },
            brandList(){
                this.brandCreateModal = false
                this.$store.dispatch('abrand/brandList', this.currentPage)
            },
            editBrand(brand){
                this.brandCreateModal = true
                this.errors = {}
                this.form = brand
                if(brand.approve == 1){
                    this.form.approve = true
                }else{
                    this.form.approve = false
                }
            },
            updateBrand(){
                axios.put('/admin/brand/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Brand updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.brandList();
                        this.brandCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            paginationChange(){
                this.$store.dispatch('abrand/brandList', this.currentPage)
            }
        },

        computed:{
            brands(){
                return this.$store.getters['abrand/getAllBrands'];
            }
        },

        created() {
            this.brandList();
        }
    }
</script>

<style scoped>

</style>
