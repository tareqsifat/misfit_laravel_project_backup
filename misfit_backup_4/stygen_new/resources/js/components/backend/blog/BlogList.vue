<template>
    <div id="blog_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Blogs List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleBlogDelete">Delete All</el-button>
                                        <router-link :to="{name: 'blogCreate'}" class="btn btn-outline-primary btn-sm"><i class="el-icon-plus"></i>  Create</router-link>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="blogs.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="130">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="title" label="Title" width="210"></el-table-column>
                                        <el-table-column label="Image" width="250">
                                            <template slot-scope="scope">
                                                <img :src="`/assets/uploads/blog/${scope.row.image}`" width='210' height='110' alt="No Image Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <router-link :to="{name: 'blogEdit', params: {id:scope.row.id}}" class="btn btn-outline-primary btn-sm"><i class="el-icon-edit"></i> Edit</router-link>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="blogDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="blogs.per_page"
                                       layout="prev, pager, next"
                                       :total="blogs.total">
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
        name: "BlogList",
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
            blogList(){
                this.blogCreateModal = false
                this.$store.dispatch('blog/blogList', this.currentPage)
            },
            blogDelete(id){
                this.$store.dispatch('blog/blogDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Blog deleted successfully.',
                    type: 'success'
                });
            },
            multipleBlogDelete(){
                axios.post('/admin/multiple-blog-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected blogs deleted successfully.',
                            type: 'success'
                        });
                        this.blogList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('blog/blogList', this.currentPage)
            }
        },

        computed:{
            blogs(){
                return this.$store.getters['blog/blogList'];
            }
        },

        created() {
            this.blogList();
        }
    }
</script>

<style scoped>

</style>
