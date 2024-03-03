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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <h3 class="card-title text-bold">Attributes List</h3>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group mb-3">
                                                <input type="text" v-model="keyword" @keyup="searchAttribute" class="form-control" placeholder="Search Attributes..." aria-label="search" aria-describedby="basic-addon2">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary search-button" @click="searchAttribute" type="button">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-right">
                                            <div class="card-tools">
                                                <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleAttributeDelete">Delete All</el-button>
                                                <el-button type="primary" icon="el-icon-plus" plain size="small" @click="attributeModalOpen">Create</el-button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="attributes.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <el-table-column type="selection" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>

                                        <el-table-column property="attribute_name" label="Attribute Name" width="210"></el-table-column>

                                        <el-table-column label="Attribute Value" width="210">
                                            <template slot-scope="scope">
                                                <span v-for="(attr_value, key) in scope.row.attributes_values" :key="attr_value.id">
                                                    {{ attr_value.attribute_value }}<span v-if="key+1 != scope.row.attributes_values.length">,</span>
                                                </span>
                                            </template>
                                        </el-table-column>

                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editAttribute(scope.row, scope.row.attributes_values)">Edit</el-button>
                                                <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="attributeDelete(scope.row.id)">Delete</el-button>
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
                        <el-select v-model="form.attribute_id" placeholder="Please Select Attribute Name">
                            <el-option v-for="attribute_name in attribute_names" :key="attribute_name.id" :label="attribute_name.attribute_name" :value="attribute_name.id"></el-option>
                        </el-select>
                        <span class="text-danger" v-if="errors['attribute_id']">{{ errors['attribute_id'][0] }}</span>
                    </el-form-item>

                    <el-row :gutter="20" v-for="(input,k) in inputs" :key="k">
                        <el-col :xs="12" :sm="12" :md="14" :lg="14" :xl="14">
                            <el-form-item label="Value">
                                <el-input v-model="input.attribute_value" placeholder="e.g. Red"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="3" :sm="3" :md="4" :lg="4" :xl="4" v-if="form.attribute_id == '1'">
                            <el-form-item label="Code">
                                <el-input type="color" v-model="input.attribute_code" placeholder="e.g. #000000"></el-input>
                            </el-form-item>
                        </el-col>

                        <el-col :xs="9" :sm="9" :md="6" :lg="6" :xl="6">
                            <span>
                                <el-form-item class="attr-value">
                                    <span class="mobile-screen">
                                        <i class="el-icon-delete" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></i>
                                        <i class="el-icon-plus" @click="add(k)" v-show="k == inputs.length-1"></i>
                                    </span>

                                    <span class="large-screen">
                                        <el-button type="danger" icon="el-icon-delete" plain size="small" @click="remove(k)" v-show="k || ( !k && inputs.length > 1)"></el-button>
                                        <el-button type="success" icon="el-icon-plus" plain size="small" @click="add(k)" v-show="k == inputs.length-1"></el-button>
                                    </span>
                                </el-form-item>
                            </span>
                        </el-col>
                    </el-row>
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
    import _ from 'lodash'
    export default {
        name: "AttributeList",
        data() {
            return {
                multipleSelection: [],
                attributeCreateModal: false,
                form: {
                    attribute_id: '',
                },
                errors: {},
                currentPage: 1,
                inputs: [{
                    attribute_value: '',
                    attribute_code: '#000000',
                }],
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
            searchAttribute:_.debounce(function(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('attribute/searchAttribute', payload)
            }, 1000),
            add () {
                this.inputs.push({
                    attribute_value: '',
                    attribute_code: '#000000',
                })
            },
            remove (index) {
                this.inputs.splice(index, 1)
            },
            clearData(){
                this.errors = {}
                this.form = {
                    attribute_id: '',
                }
                this.inputs = [{
                    attribute_value: '',
                    attribute_code: '',
                }]
            },
            attributeModalOpen(){
                this.attributeCreateModal = true
                this.clearData();
            },
            attributeList(){
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.attributeCreateModal = false
                this.$store.dispatch('sattribute/attributeList', payload)
            },
            attributeNameList(){
                this.$store.dispatch('sattribute/attributeNameList')
            },
            attributeDelete(id){
                this.$store.dispatch('sattribute/attributeDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Attribute deleted successfully.',
                    type: 'success'
                });
            },
            createAttribute(){
                axios.post('/seller/attribute', {attribute_id: this.form.attribute_id, attribute_value: this.inputs})
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Attribute created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.attributeList();
                        this.attributeCreateModal = false
                        this.inputs = [{
                            attribute_value: '',
                            attribute_code: '',
                        }]
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editAttribute(attribute, attributes_values){
                this.attributeCreateModal = true
                this.errors = {}
                this.form = attribute
                this.form.attribute_id = attribute.id
                this.inputs = attributes_values
            },
            updateAttribute(){
                axios.put('/seller/attribute/'+this.form.attribute_id, {attribute_id: this.form.attribute_id, attribute_value: this.inputs})
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
                axios.post('/seller/multiple-attribute-delete', this.multipleSelection)
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
                let payload = {'page': this.currentPage, 'keyword': this.keyword}
                this.$store.dispatch('sattribute/attributeList', payload)
            }
        },

        computed:{
            attributes(){
                return this.$store.getters['sattribute/getAllAttributes'];
            },
            attribute_names(){
                return this.$store.getters['sattribute/attributeNameList'];
            }
        },

        created() {
            this.attributeList();
            this.attributeNameList();
        }
    }
</script>

<style scoped>

</style>
