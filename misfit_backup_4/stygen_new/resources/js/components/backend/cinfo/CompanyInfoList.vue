<template>
    <div id="company_info_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Company Info List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleCompanyInfoDelete">Delete All</el-button>
                                        <router-link :to="{name: 'companyInfoCreate'}" class="btn btn-outline-primary btn-sm"><i class="el-icon-plus"></i>  Create</router-link>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="company_infos.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="130">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="facebook_link" label="Facebook URL" width="210"></el-table-column>
                                        <el-table-column property="youtube_link" label="YouTube URL" width="210"></el-table-column>
                                        <el-table-column property="twitter_link" label="Twitter URL" width="210"></el-table-column>
                                        <el-table-column property="instagram_link" label="Instagram URL" width="210"></el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <router-link :to="{name: 'companyInfoEdit', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-edit"></i> Edit</router-link>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="companyInfoDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                           background
                                           @current-change="paginationChange"
                                           :current-page.sync="currentPage"
                                           :page-size="company_infos.per_page"
                                           layout="prev, pager, next"
                                           :total="company_infos.total">
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
        name: "CompanyInfoList",
        data() {
            return {
                multipleSelection: [],
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
            companyInfoList(){
                this.$store.dispatch('cinfo/companyInfoList', this.currentPage)
            },
            companyInfoDelete(id){
                this.$store.dispatch('cinfo/companyInfoDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Company Info deleted successfully.',
                    type: 'success'
                });
            },
            multipleCompanyInfoDelete(){
                axios.post('/admin/multiple-company-info-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected company infos deleted successfully.',
                            type: 'success'
                        });
                        this.companyInfoList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('cinfo/companyInfoList', this.currentPage)
            }
        },

        computed:{
            company_infos(){
                return this.$store.getters['cinfo/companyInfoList'];
            }
        },

        created() {
            this.companyInfoList();
        }
    }
</script>

<style scoped>

</style>
