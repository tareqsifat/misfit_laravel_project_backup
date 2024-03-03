<template>
    <div id="card_list">
        <div class="content-wrapper">
            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-0">
                                    <h3 class="card-title text-bold">Greetings Card List</h3>
                                    <div class="card-tools">
                                        <el-button type="primary" icon="el-icon-plus" plain size="small" @click="cardModalOpen">Create</el-button>
                                    </div>
                                </div>

                                <div class="card-body pt-0">
                                    <el-table ref="multipleTable" :data="cards.data" style="width: 100%">
                                        <el-table-column label="SL." type="index" width="55"></el-table-column>
                                        <el-table-column label="Date" width="210">
                                            <template slot-scope="scope">{{ scope.row.created_at | timeFormat }}</template>
                                        </el-table-column>
                                        <el-table-column property="name" label="Card Name" width="210"></el-table-column>
                                        <el-table-column property="price" label="Card Price" width="210"></el-table-column>
                                        <el-table-column label="Status" width="210">
                                            <template slot-scope="scope"><span :class="scope.row.status == 1?'badge badge-success':'badge badge-secondary'">{{ scope.row.status == 1?'Publish':'Un publish' }}</span></template>
                                        </el-table-column>
                                        <el-table-column label="Actions">
                                            <template slot-scope="scope">
                                                <el-button size="mini" icon="el-icon-edit" @click.prevent="editCard(scope.row)">Edit</el-button>
                                            </template>
                                        </el-table-column>
                                    </el-table>

                                    <el-pagination class="text-center mt-3"
                                       background
                                       @current-change="paginationChange"
                                       :current-page.sync="currentPage"
                                       :page-size="cards.per_page"
                                       layout="prev, pager, next"
                                       :total="cards.total">
                                    </el-pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Card Modal Start -->
        <el-dialog
            :title= "form.id ? 'Edit Greetings Card' : 'Create Greetings Card'"
            :visible.sync="cardCreateModal"
            width="50%">
            <span>
                <el-form>
                    <el-form-item label="Card Name *">
                        <el-input v-model="form.name" placeholder="e.g. Birthday"></el-input>
                        <span class="text-danger" v-if="errors['name']">{{ errors['name'][0] }}</span>
                    </el-form-item>

                    <el-form-item label="Card Price *">
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
                <el-button @click="cardList">Cancel</el-button>
                 <el-button type="primary" v-if="!form.id" @click="createCard">Create</el-button>
                <el-button type="primary" v-else @click="updateCard">Update</el-button>
            </span>
        </el-dialog>
        <!-- Create Card Modal End -->
    </div>
</template>

<script>
    export default {
        name: "CardList",
        data() {
            return {
                multipleSelection: [],
                cardCreateModal: false,
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
            cardModalOpen(){
                this.cardCreateModal = true
                this.clearData();
            },
            cardList(){
                this.cardCreateModal = false
                this.$store.dispatch('card/cardList', this.currentPage)
            },
            createCard(){
                axios.post('/admin/card', this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Greetings Card created successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.cardList();
                        this.cardCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            editCard(card){
                this.cardCreateModal = true
                this.errors = {}
                this.form = card
                if(card.status == 1){
                    this.form.status = true
                }else{
                    this.form.status = false
                }
            },
            updateCard(){
                axios.put('/admin/card/'+this.form.id, this.form)
                    .then((result) => {
                        this.$message({
                            showClose: true,
                            message: 'Greetings Card updated successfully.',
                            type: 'success'
                        });
                        this.clearData();
                        this.cardList();
                        this.cardCreateModal = false
                    }).catch((error) => {
                    this.errors = error.response.data.errors
                });
            },
            paginationChange(){
                this.$store.dispatch('card/cardList', this.currentPage)
            }
        },

        computed:{
            cards(){
                return this.$store.getters['card/cardList'];
            }
        },

        created() {
            this.cardList();
        }
    }
</script>

<style scoped>

</style>
