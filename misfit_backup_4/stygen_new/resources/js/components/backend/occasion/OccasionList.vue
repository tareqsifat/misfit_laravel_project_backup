<template>
    <div id="occasion_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Occasions List</h3>
                                    <div class="card-tools">
                                        <!-- <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleOccasionDelete">Delete All</el-button> -->
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="occasionModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="occasions.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <!-- <el-table-column type="selection" width="55"></el-table-column> -->
                                        <el-table-column label="SL" type="index"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="occasion_name" label="Occasion Name" width="310"></el-table-column>
                                        <el-table-column label="Image" width="310">
                                            <template slot-scope="scope">
                                                <img :src="`/assets/uploads/occasion/${scope.row.occasion_image}`" width='110' height='110' alt="No Image Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Status" width="210">
                                            <template slot-scope="scope"><span :class="scope.row.status == 1?'badge badge-success':'badge badge-secondary'">{{ scope.row.status == 1?'Publish':'Un publish' }}</span></template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editOccasion(scope.row)">Edit</el-button>
                                                <!-- <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="occasionDelete(scope.row.id)">Delete</el-button> -->
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="occasions.per_page"
                                       layout="prev, pager, next"
                                       :total="occasions.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create occasion Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Occasion' : 'Create Occasion'"
            :visible.sync="occasionCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Occasion Name*">
                        <el-input v-model="form.occasion_name" placeholder="e.g. Birthday"></el-input>
                        <span class="text-danger" v-if='errors.occasion_name'>{{ errors.occasion_name[0] }}</span>
                    </el-form-item>
                    <el-form-item label="Image* (100X100)">
                        <input type="file" class="form-control" @change="changeImage">
                        <div class="mt-2">
                            <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                        </div>
                        <span class="text-danger" v-if='errors.occasion_image'>{{ errors.occasion_image[0] }}</span>
                    </el-form-item>

                    <!-- Meta Tag Section Start -->
                    <fieldset class="product-seo-fieldset">
                        <legend class="product-seo-legend">SEO Meta Tag Section:</legend>
                        <el-row class="" :gutter="20">
                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                <el-form-item label="Meta Title">
                                    <el-input v-model="form.meta_title" placeholder="e.g. Wedding Gift"></el-input>
                                    <span class="title-input-count">{{ charTitleCount(form.meta_title) }}/50</span>
                                </el-form-item>
                            </el-col>
                        </el-row>
                        <el-row class="" :gutter="20">
                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                <label>Meta Description</label>
                                <textarea class="form-control" v-model="form.meta_description" cols="30" rows="3" placeholder="e.g. Meta description"></textarea>
                                <span class="description-input-count">{{ charDesCount(form.meta_description) }}/144</span>
                            </el-col>
                        </el-row>
                        <el-form-item class="el-form-item mt-3" label="Social Image (Size: 1200X630)">
                            <input type="file" class="form-control" @change="changeMetaImage">
                            <div class="mt-2">
                                <img :src="imageMetaShow" v-if="imageMetaShow.length > 0" width="170" height="100" alt="">
                            </div>
                        </el-form-item>
                    </fieldset>
                    <!-- Meta Tag Section End -->

                    <el-form-item>
                        <label>Publish</label>
                        <el-switch v-model="form.status"></el-switch>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="occasionList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createOccasion">Create</el-button>
                <el-button type="primary" v-else @click="updateOccasion">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create occasion Modal End -->
    </div>
</template>

<script>
    export default {
        name: "OccasionList",
        data() {
            return {
                multipleSelection: [],
                occasionCreateModal: false,
                form: {
                    occasion_name: '',
                    id: '',
                    status: true,
                    meta_title: '',
                    meta_description: '',
                },
                errors: {},
                currentPage: 1,
                image:'',
                meta_image:'',
                imageShow:'',
                imageMetaShow:'',
            }
        },

        methods: {
            charTitleCount(myString){
                var totalLength         = 0;
                var withoutSpace        = 0;
                if(myString != '' && myString != null){
                    var withoutSpace    = myString.split(" ").length - 1;
                    var totalLength     = myString.length;
                }

                return totalLength - withoutSpace;
            },
            charDesCount(myString){
                var totalLength         = 0;
                var withoutSpace        = 0;
                if(myString != '' && myString != null){
                    var withoutSpace    = myString.split(" ").length - 1;
                    var totalLength     = myString.length;
                }

                return totalLength - withoutSpace;
            },
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
            changeImage(e){
                this.image = e.target.files[0]
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageShow = e.target.result
                };
                reader.readAsDataURL(file);
            },
            changeMetaImage(e){
                this.meta_image = e.target.files[0]
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageMetaShow = e.target.result
                };
                reader.readAsDataURL(file);
            },
            clearData(){
                this.errors = {}
                this.form.occasion_name = ''
                this.form.meta_title = ''
                this.form.meta_description = ''
                this.form.id = ''
                this.form = {
                    status: true
                }
            },
            occasionModalOpen(){
                this.occasionCreateModal = true
                this.clearData();
                this.image = ''
                this.meta_image = ''
                this.imageShow = ''
                this.imageMetaShow = '';
            },
            occasionList(){
                this.occasionCreateModal = false
                this.$store.dispatch('occasion/occasionList', this.currentPage)
            },
            occasionDelete(id){
                this.$store.dispatch('occasion/occasionDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Occasion deleted successfully.',
                    type: 'success'
                });
            },
            createOccasion(){
                const formData = new FormData();
                formData.append("occasion_name", this.form.occasion_name);
                formData.append("occasion_image", this.image);
                formData.append("status", this.form.status);
                formData.append("meta_title", this.form.meta_title);
                formData.append("meta_description", this.form.meta_description);
                formData.append("meta_image", this.meta_image);

                axios.post('/admin/occasion', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Occasion created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.occasionList();
                        this.occasionCreateModal = false
                        this.imageShow = ''
                        this.image = ''
                        this.imageMetaShow = '';
                        this.meta_image = ''
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editOccasion(occasion){
                this.occasionCreateModal = true
                this.errors = {}
                //this.form = occasion
                this.form.occasion_name = occasion.occasion_name
                this.form.meta_title = occasion.meta_title
                this.form.meta_description = occasion.meta_description
                if(occasion.status == 1){
                    this.form.status = true
                }else{
                    this.form.status = false
                }
                this.form.id = occasion.id
                this.imageShow = '/assets/uploads/occasion/'+occasion.occasion_image
                this.imageMetaShow = '/assets/uploads/occasion/meta/'+occasion.meta_image
            },
            updateOccasion(){
                const formData = new FormData();
                formData.append("id", this.form.id);
                formData.append("occasion_name", this.form.occasion_name);
                formData.append("occasion_image", this.image);
                formData.append("status", this.form.status);
                formData.append("meta_title", this.form.meta_title);
                formData.append("meta_description", this.form.meta_description);
                formData.append("meta_image", this.meta_image);

                axios.post('/admin/occasion-update', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Occasion updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.occasionList();
                        this.occasionCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleOccasionDelete(){
                axios.post('/admin/multiple-occasion-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected occasions deleted successfully.',
                            type: 'success'
                        });
                        this.occasionList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('occasion/occasionList', this.currentPage)
            }
        },

        computed:{
            occasions(){
                return this.$store.getters['occasion/occasionList'];
            }
        },

        created() {
            this.occasionList();
        }
    }
</script>

<style scoped>

</style>
