<template>
    <div class="container">
        <div class="card list_card">
            <div class="card-header">
                <h4>Add subjects</h4>
                <div class="btns">
                    <router-link :to="{ name: `AllBranchBatch` }" class="btn rounded-pill btn-outline-warning" >
                        <i class="fa fa-arrow-left me-5px"></i>
                        Back
                    </router-link>
                </div>
            </div>
            <form @submit.prevent="call_store(`store_${store_prefix}`,$event.target)" class="add_subject_form" autocomplete="false" enctype="multipart/form-data">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="row">
                            <div class="col-md-5">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="class">Class</label>
                                    <input type="text" :value="get_batch_subjects.class.title" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class=" form-group d-grid align-content-start gap-1 mb-2">
                                    <label for="class">Batch</label>
                                    <input type="text" :value="get_batch_subjects.name" class="form-control" disabled>
                                </div>
                            </div>
                            <div class="mb-3" data-repeater-list="group-a">
                                <div class="repeater-wrapper pt-0 pt-md-4" data-repeater-item="">
                                    <label class="form-label" for="collapsible-address"><h5>Subjects</h5></label>
                                    <div class="d-flex rounded position-relative pe-0" v-for="(input,index) in subjects" :key="index">
                                        <div class="row w-100 p-1">
                                            <div class="col-md-6 col-12 mb-md-0 mb-2">
                                                <p class="mb-2 repeater-title">Title</p>
                                                <input type="text" v-model="input.title" class="form-control invoice-item-price mb-3" placeholder="subject name" />
                                            </div>
                                            <div class="col-md-2 col-6">
                                                <p class="mb-2 repeater-title">Action</p>
                                                <button type="button" @click="addSubject(index)" class="btn btn-primary waves-effect waves-light" data-repeater-create=""><i class="fa fa-plus"></i></button>
                                                <button v-if="subjects.length>1" type="button" @click="removeSubject(index, input)" class="btn btn-danger waves-effect waves-light" data-repeater-create=""><i class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button type="submit" class="btn btn-outline-info" >
                        <i class="fa fa-upload"></i>
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import InputField from '../../../components/InputField.vue'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { InputField },
    data: function(){
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
            subjects: [
                {
                    title: "",
                }
            ],
        }
    },
    created: function () {
        this[`fetch_class_batch_subjects`](this.$route.params.id);
    },
    watch: {
        get_batch_subjects: function(val) {
            if(val.subjects.length > 0) {
                this.subjects = val.subjects
            }else {
                this.subjects = [
                    {
                        title: "",
                    }
                ];
                // console.log('subjects not found!');
            }
        },
    },
    methods: {
        ...mapActions([
            `store_${store_prefix}`,
            `fetch_class_batch_subjects`,
            `delete_${store_prefix}`
        ]),
        call_store: function(name, params){
            params = {
                subjects: this.subjects,
                batch_id: this.$route.params.id
            }

            this[name](params)
        },
        // add specification
        addSubject() {
            this.subjects.push({
                title: "",
            })
        },

        // remove specification
        removeSubject(index, input) {
            // console.log(input);
            if(input.hasOwnProperty('id')) {
                this[`delete_${store_prefix}`](input.id);   
                this.subjects.splice(index, 1);
                // this.delete_class_subject(input.id);
            }else {
                this.subjects.splice(index, 1);
            }
        },
    },
    computed: {
        ...mapGetters([`get_batch_subjects`])
    }
};
</script>

<style>
</style>
