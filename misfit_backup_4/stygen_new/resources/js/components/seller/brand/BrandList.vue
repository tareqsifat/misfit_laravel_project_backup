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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="card-title text-bold">Brands List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchBrand" class="form-control" placeholder="Search Brands..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchBrand" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="card-tools">
                                                <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleBrandDelete">Delete All</el-button>
                                                <el-button type="primary" icon="el-icon-plus" plain size="small" @click="brandModalOpen">Create</el-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="brands.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
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
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="brandDelete(scope.row.id)">Delete</el-button>
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
            :title= "form.id ? 'Edit Brand' : 'Create Brand'"
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
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="brandList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createBrand">Create</el-button>
                <el-button type="primary" v-else @click="updateBrand">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Category Modal End -->
    </div>
</template>

<script>
    import _ from 'lodash'
    export default {
        name: "BrandList",
        data() {
            return {
                multipleSelection: [],
                brandCreateModal: false,
                form: {},
                errors: {},
                currentPage: 1,
                keyword:''
            }
        },

        methods: {
            searchBrand:_.debounce(function(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('brand/searchBrand', payload)
            }, 1000),
            toggleSelection(rows) {
                if (rows) {
                    rows.forEach(row => {
                        this.$refs.multipleTable.toggleRowSelection(row);
                    });
                } else {
                    this.$refs.multipleTable.clearSelection();
                }
            },

            clearData(){
                this.errors = {}
                this.form = {}
            }, handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            brandModalOpen(){
                this.brandCreateModal = true
                this.clearData();
            },
            brandList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.brandCreateModal = false
                this.$store.dispatch('brand/brandList', payload)
            },
            brandDelete(id){
                this.$store.dispatch('brand/brandDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Brand deleted successfully.',
                    type: 'success'
                });
            },
            createBrand(){
                axios.post('/seller/brand', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Brand created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.brandList();
                        this.brandCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editBrand(brand){
                this.brandCreateModal = true
                this.errors = {}
                this.form = brand
            },
            updateBrand(){
                axios.put('/seller/brand/'+this.form.id, this.form)
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
            multipleBrandDelete(){
                axios.post('/seller/multiple-brand-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected brands deleted successfully.',
                            type: 'success'
                        });
                        this.brandList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('brand/brandList', payload)
            }
        },

        computed:{
            brands(){
                return this.$store.getters['brand/getAllBrands'];
            }
        },

        created() {
            this.brandList();
        }
    }
</script>

<style scoped>

</style>
