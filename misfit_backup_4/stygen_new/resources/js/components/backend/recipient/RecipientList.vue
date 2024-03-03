<template>
    <div id="recipient_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Recipient List</h3>
                                    <div class="card-tools">
                                        <!-- <el-button v-if="multipleSelection.length > 0" type="danger" icon="el-icon-delete" plain size="small" @click="multipleOccasionDelete">Delete All</el-button> -->
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="recipientModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="recipients.data" style="width: 100%" @selection-change="handleSelectionChange">
                                        <!-- <el-table-column type="selection" width="55"></el-table-column> -->
                                        <el-table-column label="SL" type="index"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="recipient_name" label="Recipient Name" width="310"></el-table-column>
                                        <el-table-column label="Image" width="310">
                                            <template slot-scope="scope">
                                                <img :src="`/assets/uploads/recipient/${scope.row.recipient_image}`" width='110' height='110' alt="No Image Found">
                                            </template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editRecipient(scope.row)">Edit</el-button>
                                                <!-- <el-button size="mini" icon="el-icon-delete" type="danger" @click.prevent="recipientDelete(scope.row.id)">Delete</el-button> -->
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="recipients.per_page"
                                       layout="prev, pager, next"
                                       :total="recipients.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create recipient Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Recipient' : 'Create Recipient'"
            :visible.sync="recipientCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Recipient Name*">
                        <el-input v-model="form.recipient_name" placeholder="e.g. Couple"></el-input>
                        <span class="text-danger" v-if='errors.recipient_name'>{{ errors.recipient_name[0] }}</span>
                    </el-form-item>
                    <el-form-item label="Image* (100X100)">
                        <input type="file" class="form-control" @change="changeImage">
                        <div class="mt-2">
                            <img :src="imageShow" v-if="imageShow.length > 0" width="100" height="100" alt="">
                        </div>
                        <span class="text-danger" v-if='errors.recipient_image'>{{ errors.recipient_image[0] }}</span>
                    </el-form-item>
                </el-form>
            </span>
            <span slot="footer" class="dialog-footer">
                <el-button @click="recipientList">Cancel</el-button>
                <el-button type="primary" v-if="!form.id" @click="createRecipient">Create</el-button>
                <el-button type="primary" v-else @click="updateRecipient">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create recipient Modal End -->
    </div>
</template>

<script>
    export default {
        name: "RecipientList",
        data() {
            return {
                multipleSelection: [],
                recipientCreateModal: false,
                form: {
                    recipient_name: '',
                    id: ''
                },
                errors: {},
                currentPage: 1,
                image:'',
                imageShow:''
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
                this.form.recipient_name = ''
                this.form.id = ''
            },
            recipientModalOpen(){
                this.recipientCreateModal = true
                this.clearData();
                this.image = ''
                this.imageShow = ''
            },
            recipientList(){
                this.recipientCreateModal = false
                this.$store.dispatch('recipient/recipientList', this.currentPage)
            },
            recipientDelete(id){
                this.$store.dispatch('recipient/recipientDelete', id)
                this.$message({
                    showClose: true,
                    message: 'Recipient deleted successfully.',
                    type: 'success'
                });
            },
            createRecipient(){
                const formData = new FormData();
                formData.append("recipient_name", this.form.recipient_name);
                formData.append("recipient_image", this.image);

                axios.post('/admin/recipient', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Recipient created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.recipientList();
                        this.recipientCreateModal = false
                        this.imageShow = ''
                        this.image = ''
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editRecipient(recipient){
                this.recipientCreateModal = true
                this.errors = {}
                //this.form = recipient
                this.form.recipient_name = recipient.recipient_name
                this.form.id = recipient.id
                this.imageShow = '/assets/uploads/recipient/'+recipient.recipient_image
            },
            updateRecipient(){
                const formData = new FormData();
                formData.append("id", this.form.id);
                formData.append("recipient_name", this.form.recipient_name);
                formData.append("recipient_image", this.image);

                axios.post('/admin/recipient-update', formData)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Recipient updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.recipientList();
                        this.recipientCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            multipleRecipientDelete(){
                axios.post('/admin/multiple-recipient-delete', this.multipleSelection)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Selected recipients deleted successfully.',
                            type: 'success'
                        });
                        this.recipientList();
                    }).catch((error) => {

                });
            },
            paginationChange(){
                this.$store.dispatch('recipient/recipientList', this.currentPage)
            }
        },

        computed:{
            recipients(){
                return this.$store.getters['recipient/recipientList'];
            }
        },

        created() {
            this.recipientList();
        }
    }
</script>

<style scoped>

</style>
