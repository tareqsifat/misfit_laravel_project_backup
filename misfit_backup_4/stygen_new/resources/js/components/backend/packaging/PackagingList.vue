<template>
    <div id="packaging_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Packaging List</h3>
                                    <div class="card-tools">
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="packagingModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="packagings.data" style="width: 100%">
                                        <el-table-column label="SL." type="index" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="name" label="Packaging Name" width="210"></el-table-column>
                                        <el-table-column property="price" label="Packaging Price" width="210"></el-table-column>
                                        <el-table-column label="Status" width="210">
                                            <template slot-scope="scope"><span :class="scope.row.status == 1?'badge badge-success':'badge badge-secondary'">{{ scope.row.status == 1?'Publish':'Un publish' }}</span></template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editPackaging(scope.row)">Edit</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="packagings.per_page"
                                       layout="prev, pager, next"
                                       :total="packagings.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Packaging Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Packaging' : 'Create Packaging'"
            :visible.sync="packagingCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Packaging Name *">
                        <el-input v-model="form.name" placeholder="e.g. Premium"></el-input>
                        <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Packaging Price *">
                        <el-input v-model="form.price" placeholder="e.g. 20"></el-input>
                        <span class="text-danger" v-if="errors['price']">{{ errors['price'][0] }}</span>
                    </el-form-item>

                    <el-form-item>
                        <label>Publish</label>
                        <el-switch v-model="form.status"></el-switch>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="packagingList">Cancel</el-button>
                 <el-button type="primary" v-if="!form.id" @click="createPackaging">Create</el-button>
                <el-button type="primary" v-else @click="updatePackaging">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Packaging Modal End -->
    </div>
</template>

<script>
    export default {
        name: "PackagingList",
        data() {
            return {
                multipleSelection: [],
                packagingCreateModal: false,
                form: {
                    status: true
                },
                errors: {},
                currentPage: 1,
            }
        },

        methods: {
            clearData(){
                this.errors = {}
                this.form = {
                    status: true
                }
            },
            packagingModalOpen(){
                this.packagingCreateModal = true
                this.clearData();
            },
            packagingList(){
                this.packagingCreateModal = false
                this.$store.dispatch('packaging/packagingList', this.currentPage)
            },
            createPackaging(){
                axios.post('/admin/packaging', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Packaging created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.packagingList();
                        this.packagingCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editPackaging(packaging){
                this.packagingCreateModal = true
                this.errors = {}
                this.form = packaging
                if(packaging.status == 1){
                    this.form.status = true
                }else{
                    this.form.status = false
                }
            },
            updatePackaging(){
                axios.put('/admin/packaging/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Packaging updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.packagingList();
                        this.packagingCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            paginationChange(){
                this.$store.dispatch('packaging/packagingList', this.currentPage)
            }
        },

        computed:{
            packagings(){
                return this.$store.getters['packaging/packagingList'];
            }
        },

        created() {
            this.packagingList();
        }
    }
</script>

<style scoped>

</style>
