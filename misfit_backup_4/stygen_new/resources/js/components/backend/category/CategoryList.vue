<template>
    <div id="admin_category_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Categories List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleCategoryDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="categoryModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="categories.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <!--<el-table-column type="selection" width="55"></el-table-column>-->
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="category_name" label="Name" width="210"></el-table-column>

                                        <el-table-column  label="Image" width="210">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.category_image"><img :src="`/assets/uploads/category/${scope.row.category_image}`" width="100px" height="100px" alt="Not Found"></span>
                                                <span v-else><img src="/assets/frontend/img/icon/empty_product.jpeg" width="100px" height="100px"></span>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editCategory(scope.row)">Edit</el-button>
                                                <el-button v-if="scope.row.product_categories && scope.row.product_categories.length == 0" size="mini" icon="el-icon-delete" type="danger" @click.prevent="categoryDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                        background
                                        @current-change="paginationChange"
                                        :current-page.sync="currentPage"
                                        :page-size="categories.per_page"
                                        layout="prev, pager, next"
                                        :total="categories.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Category Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Category' : 'Create Category'"
            :visible.sync="categoryCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Category Name *">
                        <el-select v-model="form.category_name" filterable allow-create placeholder="Category Name">
                            <el-option v-for="category in getAllCategories" :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                        </el-select>
                        <!--<el-input v-model="form.category_name" placeholder="e.g. Gift For Occasions"></el-input>-->
                        <span class="text-danger" v-if="errors['category_name']">{{ errors['category_name'][0] }}</span>
                        <span class="text-danger" v-if="catMsg">Category already exists. Please try another one.</span>
                    </el-form-item>

                    <el-form-item label="Parent Category">
                        <el-select v-model="form.parent_id" placeholder="Please Select Parent Category">
                            <template v-for="category in all_categories">
                                <el-option :key="category.id" :label="category.category_name" :value="category.id"></el-option>
                                <ul v-if="category.subcategory">
                                    <li v-for="subcategory in category.subcategory" :key="subcategory.id">
                                        <el-option :key="subcategory.id" :label="subcategory.category_name" :value="subcategory.id"></el-option>
                                        <sub-category-list :subcategories="subcategory.subcategory"></sub-category-list>
                                    </li>
                                </ul>
                            </template>
                        </el-select>
                    </el-form-item>

                    <el-checkbox-group v-model="approve_category">
                        <el-checkbox label="Show in home page"></el-checkbox>
                    </el-checkbox-group>

                    <el-form-item label="Description">
                        <el-input type="textarea" v-model="form.category_description" placeholder="e.g. Description"></el-input>
                    </el-form-item>

                    <el-form-item label="Image (Size: 300X300)">
                        <input type="file" class="form-control" @change="changeImage">
                        <div class="mt-2">
                            <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                        </div>
                    </el-form-item>

                    <!-- Meta Tag Section Start -->
                    <fieldset class="product-seo-fieldset">
                        <legend class="product-seo-legend">SEO Meta Tag Section:</legend>
                        <el-row class="" :gutter="20">
                            <el-col :xs="24" :sm="24" :md="24" :lg="24" :xl="24">
                                <el-form-item label="Meta Title">
                                    <el-input v-model="form.meta_title" placeholder="e.g. Books"></el-input>
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
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="categoryList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createCategory">Create</el-button>
                <el-button type="primary" v-else @click="updateCategory">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Category Modal End -->
    </div>
</template>

<script>
    import SubCategoryList from './SubCategoryList'
    export default {
        name: "CategoryList",
        components:{
            SubCategoryList
        },
        data() {
            return {
                multipleSelection: [],
                categoryCreateModal: false,
                form: {
                    category_name: '',
                    parent_id: '',
                    category_description: '',
                    meta_title: '',
                    meta_description: '',
                },
                errors: {},
                currentPage: 1,
                subcategories: [],
                image:'',
                meta_image:'',
                imageShow:'',
                imageMetaShow:'',
                catMsg: false,
                approve_category: false,
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
                this.form = {
                    category_name: '',
                    parent_id: '',
                    category_description: '',
                    meta_title: '',
                    meta_description: '',
                    approve_category: false,
                }
            },
            categoryModalOpen(){
                this.categoryCreateModal = true
                this.approve_category = false
                this.imageShow = '';
                this.imageMetaShow = '';
                this.clearData();
            },
            categoryList(){
                this.categoryCreateModal = false
                this.$store.dispatch('acategory/categoryList', this.currentPage)
            },
            categoryDelete(id){
                this.$store.dispatch('acategory/categoryDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Category deleted successfully.',
                    type: 'success'
                });
            },
            createCategory(){
                const formData = new FormData();
                formData.append("category_name", this.form.category_name);
                formData.append("parent_id", this.form.parent_id);
                formData.append("category_description", this.form.category_description);
                formData.append("image", this.image);
                formData.append("approve_category", this.approve_category);
                formData.append("meta_title", this.form.meta_title);
                formData.append("meta_description", this.form.meta_description);
                formData.append("meta_image", this.meta_image);

                axios.post('/admin/category', formData)
                .then((result) => {
                    if(result.data == 'error'){
                        this.catMsg = true;
                    }else{
                        this.catMsg = false;
                        this.imageShow = '';
                        this.imageMetaShow = '';
                        this.getAllCategory();
                        this.clearData();
                        this.approve_category = false
                        this.categoryList();
                        this.allCategoriesList();
                        this.categoryCreateModal = false
                        this.$message({
                            showClose: true,
                            message: 'Category created successfully.',
                            type: 'success'
                        });
                    }
                }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editCategory(category){
                this.categoryCreateModal = true
                this.errors = {}
                this.imageShow = '/assets/uploads/category/'+category.category_image
                this.imageMetaShow = '/assets/uploads/category/meta/'+category.meta_image
                this.form = category
                if(category.approve_category == 1){
                    this.approve_category = true
                }else{
                    this.approve_category = false
                }
                if(category.parent_id === 0){
                    this.form.parent_id = ''
                }
            },
            updateCategory(){
                const formData = new FormData();
                formData.append("category_name", this.form.category_name);
                formData.append("parent_id", this.form.parent_id);
                formData.append("category_description", this.form.category_description);
                formData.append("image", this.image);
                formData.append("id", this.form.id);
                formData.append("approve_category", this.approve_category);
                formData.append("meta_title", this.form.meta_title);
                formData.append("meta_description", this.form.meta_description);
                formData.append("meta_image", this.meta_image);

                axios.post('/admin/category-update', formData)
                    .then((result) => {
                        this.clearData();
                        this.approve_category = false
                        this.categoryList();
                        this.allCategoriesList();
                        this.categoryCreateModal = false
                        this.$message({
                            showClose: true,
                            message: 'Category updated successfully.',
                            type: 'success'
                        });
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleCategoryDelete(){
                axios.post('/admin/multiple-category-delete', this.multipleSelection)
                .then((result) => {
                    this.$message({
                        showClose: true,
                        message: 'Selected categories deleted successfully.',
                        type: 'success'
                    });
                    this.categoryList();
                }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('acategory/categoryList', this.currentPage)
            },
            allCategoriesList(){
                this.$store.dispatch('acategory/allCategoriesList');
            },
            getAllCategory(){
                this.$store.dispatch('acategory/getAllCategory');
            }
        },

        computed:{
            categories(){
                return this.$store.getters['acategory/getAllCategories'];
            },
            all_categories(){
                return this.$store.getters['acategory/allCategories'];
            },
            getAllCategories(){
                return this.$store.getters['acategory/getAllCategory'];
            }
        },

        created() {
            this.categoryList();
            this.allCategoriesList();
            this.getAllCategory();
        }
    }
</script>

<style scoped>

</style>
