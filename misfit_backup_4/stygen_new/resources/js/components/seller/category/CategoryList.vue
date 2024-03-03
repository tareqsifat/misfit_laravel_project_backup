<template>
    <div id="category_list">
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
                                            <h3 class="card-title text-bold">Categories List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchCategory" class="form-control" placeholder="Search Category..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchCategory" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="card-tools">
                                                <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleCategoryDelete">Delete All</el-button>
                                                <el-button type="primary" icon="el-icon-plus" plain size="small" @click="categoryModalOpen">Create</el-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="categories.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <!--<el-table-column type="selection" width="55"></el-table-column>-->
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="category_name" label="Name" width="210"></el-table-column>

                                        <el-table-column property="category_description" label="Category Description" width="490"></el-table-column>
                                        <!--<el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editCategory(scope.row)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="categoryDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>-->
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

                    <el-form-item label="Description">
                        <el-input type="textarea" v-model="form.category_description" placeholder="e.g. Description"></el-input>
                    </el-form-item>

                    <!--<el-form-item label="Image">
                        <input type="file" class="form-control" @change="changeImage">
                        <div class="mt-2">
                            <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                        </div>
                    </el-form-item>-->
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
    import _ from 'lodash'
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
                },
                errors: {},
                currentPage: 1,
                subcategories: [],
                image:'',
                imageShow:'',
                catMsg: false,
                keyword: ''
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
            searchCategory:_.debounce(function(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('category/searchCategory', payload)
            }, 1000),
            changeImage(e){
                this.image = e.target.files[0]
                let file = e.target.files[0];
                let reader = new FileReader();
                reader.onload = e => {
                    this.imageShow = e.target.result
                };
                reader.readAsDataURL(file);
            },
            clearData(){
                this.errors = {}
                this.form = {
                    category_name: '',
                    parent_id: '',
                    category_description: '',
                }
            },
            categoryModalOpen(){
                this.categoryCreateModal = true
                this.clearData();
            },
            categoryList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.categoryCreateModal = false
                this.$store.dispatch('category/categoryList', payload)
            },
            categoryDelete(id){
                this.$store.dispatch('category/categoryDelete', id)
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
                //formData.append("image", this.image);

                axios.post('/seller/category', formData)
                .then((result) => {
                    if(result.data == 'error'){
                        this.catMsg = true;
                    }else{
                        this.catMsg = false;
                        this.getAllCategory();
                        this.clearData();
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
                this.form = category
            },
            updateCategory(){
                const formData = new FormData();
                formData.append("category_name", this.form.category_name);
                formData.append("parent_id", this.form.parent_id);
                formData.append("category_description", this.form.category_description);
                //formData.append("image", this.image);
                formData.append("id", this.form.id);

                axios.post('/seller/category-update', formData)
                    .then((result) => {
                        this.clearData();
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
                axios.post('/seller/multiple-category-delete', this.multipleSelection)
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
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('category/categoryList', payload)
            },
            allCategoriesList(){
                this.$store.dispatch('category/allCategoriesList');
            },
            getAllCategory(){
                this.$store.dispatch('category/getAllCategory');
            }
        },

        computed:{
            categories(){
                return this.$store.getters['category/getAllCategories'];
            },
            all_categories(){
                return this.$store.getters['category/allCategories'];
            },
            getAllCategories(){
                return this.$store.getters['category/getAllCategory'];
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
