<template>
    <div id="attribute_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Attributes List</h3>
                                    <div class="card-tools">
                                        <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleAttributeDelete">Delete All</el-button>
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="attributeModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="attributes.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <!--<el-table-column type="selection" width="55"></el-table-column>-->
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="attribute_name" label="Attribute Name" width="310"></el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editAttribute(scope.row, scope.row.attributes_values)">Edit</el-button>
                                                <!--<el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="attributeDelete(scope.row.id)">Delete</el-button>-->
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="attributes.per_page"
                                       layout="prev, pager, next"
                                       :total="attributes.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Attribute Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Attribute' : 'Create Attribute'"
            :visible.sync="attributeCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Name *">
                        <el-input v-model="form.attribute_name" placeholder="e.g. Color"></el-input>
                        <span class="text-danger" v-if="errors['attribute_name']">{{ errors['attribute_name'][0] }}</span>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="attributeList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click.prevent="createAttribute">Create</el-button>
                <el-button type="primary" v-else @click="updateAttribute">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Attribute Modal End -->
    </div>
</template>

<script>
    export default {
        name: "AttributeList",
        data() {
            return {
                multipleSelection: [],
                attributeCreateModal: false,
                form: {
                    attribute_name: '',
                },
                errors: {},
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
            attributeModalOpen(){
                this.attributeCreateModal = true
                this.clearData();
            },
            attributeList(){
                this.attributeCreateModal = false
                this.$store.dispatch('attribute/attributeList', this.currentPage)
            },
            attributeDelete(id){
                this.$store.dispatch('attribute/attributeDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Attribute deleted successfully.',
                    type: 'success'
                });
            },
            createAttribute(){
                axios.post('/admin/attribute', {attribute_name: this.form.attribute_name})
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Attribute created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.attributeList();
                        this.attributeCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editAttribute(attribute, attributes_values){
                this.attributeCreateModal = true
                this.errors = {}
                this.form = attribute
                this.inputs = attributes_values
            },
            updateAttribute(){
                axios.put('/admin/attribute/'+this.form.id, {attribute_name: this.form.attribute_name})
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Attribute updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.attributeList();
                        this.attributeCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleAttributeDelete(){
                axios.post('/admin/multiple-attribute-delete', this.multipleSelection)
                .then((result) => {
                    this.$message({
                        showClose: true,
                        message: 'Selected attributes deleted successfully.',
                        type: 'success'
                    });
                    this.attributeList();
                }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('attribute/attributeList', this.currentPage)
            }
        },

        computed:{
            attributes(){
                return this.$store.getters['attribute/getAllAttributes'];
            }
        },

        created() {
            this.attributeList();
        }
    }
</script>

<style scoped>

</style>
