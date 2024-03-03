<template>
    <div id="slider_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Sliders List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleSliderDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="sliderModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="sliders.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="150">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="title" label="Title" width="120"></el-table-column>
                                        <el-table-column label="Image" width="310">
                                            <template slot-scope="scope">
                                                <img :src="`/assets/uploads/slider/${scope.row.image}`" width='210' height='110' alt="No Image Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Show in Gift Occasion" width="200">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.show_single_product == 1"><span class="badge badge-success">Showing</span></span>
                                                <span v-else><span class="badge badge-danger">Not Showing</span></span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Show in Home Page" width="200">
                                            <template slot-scope="scope">
                                                <span v-if="scope.row.show_home_page == 1"><span class="badge badge-success">Showing</span></span>
                                                <span v-else><span class="badge badge-danger">Not Showing</span></span>
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editSlider(scope.row)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="sliderDelete(scope.row.id)">Delete</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="sliders.per_page"
                                       layout="prev, pager, next"
                                       :total="sliders.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Create Slider Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Slider' : 'Create Slider'"
            :visible.sync="sliderCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Title">
                        <el-input v-model="form.title" placeholder="e.g. Eid Offer"></el-input>
                    </el-form-item>
                    <el-form-item label="Image (870*470)">
                        <input type="file" class="form-control" @change="changeImage">
                        <div class="mt-2">
                            <img :src="imageShow" v-if="imageShow.length > 0" width="200" height="110" alt="">
                        </div>
                        <span class="text-danger" v-if='errors.image'>{{ errors.image[0] }}</span>
                    </el-form-item>
                    <el-form-item label="Gift by Occasion">
                        <el-select v-model="form.occasion_id" placeholder="Please Select Occasion">
                            <el-option v-for="occasion in occasions" :key="occasion.id" :label="occasion.occasion_name" :value="occasion.id"></el-option>
                        </el-select>
                        <span class="text-danger" v-if='errors.occasion_id'>{{ errors.occasion_id[0] }}</span>
                    </el-form-item>
                    <el-checkbox-group v-model="show_single_product">
                        <el-checkbox label="Show in Gift Occasion Page"></el-checkbox>
                    </el-checkbox-group>

                    <el-checkbox-group v-model="show_home_page">
                        <el-checkbox label="Show in Home Page"></el-checkbox>
                    </el-checkbox-group>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="sliderList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createSlider">Create</el-button>
                <el-button type="primary" v-else @click="updateSlider">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Slider Modal End -->
    </div>
</template>

<script>
    export default {
        name: "SliderList",
        data() {
            return {
                multipleSelection: [],
                sliderCreateModal: false,
                form: {
                    title: '',
                    occasion_id: ''
                },
                errors: {},
                currentPage: 1,
                image:'',
                imageShow:'',
                show_single_product: false,
                show_home_page: false
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
                    title: ''
                }
            },
            sliderModalOpen(){
                this.sliderCreateModal = true
                this.clearData();
                this.image = ''
                this.imageShow = ''
                this.show_single_product = false
                this.show_home_page = false
            },
            sliderList(){
                this.sliderCreateModal = false
                this.$store.dispatch('slider/sliderList', this.currentPage)
            },
            sliderDelete(id){
                this.$store.dispatch('slider/sliderDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Slider deleted successfully.',
                    type: 'success'
                });
            },
            createSlider(){
                const formData = new FormData();
                formData.append("title", this.form.title);
                formData.append("occasion_id", this.form.occasion_id);
                formData.append("image", this.image);
                formData.append("show_single_product", this.show_single_product);
                formData.append("show_home_page", this.show_home_page);

                axios.post('/admin/slider', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Slider created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.sliderList();
                        this.sliderCreateModal = false
                        this.imageShow = ''
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editSlider(slider){
                this.sliderCreateModal = true
                this.errors = {}
                this.form = slider
                if(slider.show_single_product == 1){
                    this.show_single_product = true
                }else{
                    this.show_single_product = false
                }
                if(slider.show_home_page == 1){
                    this.show_home_page = true
                }else{
                    this.show_home_page = false
                }
                this.imageShow = '/assets/uploads/slider/'+slider.image
            },
            updateSlider(){
                const formData = new FormData();
                formData.append("id", this.form.id);
                formData.append("title", this.form.title);
                formData.append("image", this.image);
                formData.append("occasion_id", this.form.occasion_id);
                formData.append("show_single_product", this.show_single_product);
                formData.append("show_home_page", this.show_home_page);

                axios.post('/admin/slider-update', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Slider updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.sliderList();
                        this.sliderCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleSliderDelete(){
                axios.post('/admin/multiple-slider-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected sliders deleted successfully.',
                            type: 'success'
                        });
                        this.sliderList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('slider/sliderList', this.currentPage)
            },
            getAllOccasion(){
                this.$store.dispatch('occasion/getAllOccasion');
            }
        },

        computed:{
            sliders(){
                return this.$store.getters['slider/sliderList'];
            },
            occasions(){
                return this.$store.getters['occasion/getAllOccasion']
            }
        },

        created() {
            this.sliderList();
            this.getAllOccasion();
        }
    }
</script>

<style scoped>

</style>
