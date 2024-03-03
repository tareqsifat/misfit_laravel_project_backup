<template>
    <div class="canvas_backdrop" :class="{ active: this[`get_${store_prefix}`] }"
        @click="$event.target.classList.contains('canvas_backdrop') && call_store(`set_${store_prefix}`, null)">
        <div class="content right" v-if="this[`get_${store_prefix}`]">
            <div class="content_header">
                <div class="d-flex gap-2">
                    <h3 class="offcanvas-title"></h3>
                    <div>
                        <a @click.prevent="call_store(`approve_${store_prefix}`,{status: 'approve'})" class="btn btn-sm btn-outline-info rounded-pill" v-if="this[`get_${store_prefix}`].application_status == 'pending'" href="#">Approve</a>
                        <a @click.prevent="call_store(`approve_${store_prefix}`,{status: 'dis approve'})" class="btn btn-sm btn-outline-warning rounded-pill" v-else href="#">Dis Approve</a>
                        <a @click.prevent="call_store(`soft_delete_${store_prefix}`, get_key('id'))" v-if="get_key('status') == 1" class="btn btn-sm btn-outline-danger rounded-pill" href="#">Delete</a>
                        <a @click.prevent="call_store(`restore_${store_prefix}`, get_key('id'))" v-else class="btn btn-sm btn-outline-danger rounded-pill" href="#">Restore</a>
                    </div>
                </div>
                <i @click="call_store(`set_${store_prefix}`, null)" class="fa fa-times"></i>
            </div>
            <div class="cotent_body">
                <table class="table">
                    <tbody>
                        <tr>
                            <td style="width: 205px;">image</td>
                            <td>:</td>
                            <td>
                                <img height="80px" :src="`/${this[`get_${store_prefix}`].image}`" alt="">
                            </td>
                        </tr>

                        <tr v-for="i in [
                            'id', 'full_name', 'father_name', 'nid', 'date_of_birth', 'gender', 'present_address',
                            'permanent_address', 'nationality', 'phone_number', 'email'
                        ]" :key="i">
                            <td>{{ i.replaceAll('_',' ') }}</td>
                            <td>:</td>
                            <td>{{ get_value(i) }}</td>
                        </tr>

                        <tr>
                            <td>Education Qualification</td>
                            <td>:</td>
                            <td>
                                <div v-html="get_qualification()"></div>
                            </td>
                        </tr>

                        <tr>
                            <td>Category of Exam</td>
                            <td>:</td>
                            <td>
                                <div v-html="get_category_of_exam()"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Application For</td>
                            <td>:</td>
                            <td>
                                <div v-html="get_application_for()"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Essay</td>
                            <td>:</td>
                            <td>
                                <div v-html="get_essay()"></div>
                            </td>
                        </tr>
                        <tr>
                            <td>Previous Attempted</td>
                            <td>:</td>
                            <td>
                                <div v-html="get_previous_attemped()"></div>
                            </td>
                        </tr>

                        <!-- <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <span v-if="this[`get_${store_prefix}`].status == 1" class="badge bg-label-success me-1">active</span>
                                <span v-if="this[`get_${store_prefix}`].status == 0" class="badge bg-label-success me-1">deactive</span>
                            </td>
                        </tr> -->
                        <tr>
                            <td>created at</td>
                            <td>:</td>
                            <td>{{ new Date(this[`get_${store_prefix}`].created_at).toLocaleString() }}</td>
                        </tr>
                        <!-- <tr>
                            <td>udpated at</td>
                            <td>:</td>
                            <td>{{ new Date(this[`get_${store_prefix}`].updated_at).toLocaleString() }}</td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const { route_prefix, store_prefix } = PageSetup;
export default {
    data: function () {
        return {
            /** store prefix for JSX */
            store_prefix,
            route_prefix,
        }
    },
    methods: {
        ...mapActions([`approve_${store_prefix}`, `soft_delete_${store_prefix}`, `restore_${store_prefix}`]),
        ...mapMutations([`set_${store_prefix}`]),
        call_store: function (name, params = null) {
            this[name](params)
        },
        get_value: function(v){
            return this[`get_${store_prefix}`][v];
        },
        get_qualification: function(){
            var object = this[`get_${store_prefix}`]['education_qualification'];
            var html = ``;
            for (const key in object) {
                if (Object.hasOwnProperty.call(object, key)) {
                    const item = object[key];
                    if(item.qualification){
                        html += `<div>
                                &nbsp; ${item.qualification || ''} &nbsp; :
                                &nbsp; ${item.year || ''} &nbsp; -
                                &nbsp; ${item.subject || ''} &nbsp; -
                                &nbsp; ${item.grade || ''} &nbsp;
                            </div>`;
                    }
                }
            }
            return html
        },
        get_category_of_exam: function(){
            var object = this[`get_${store_prefix}`]['category_of_exam'];
            var html = ``;
            for (const key in object) {
                if (Object.hasOwnProperty.call(object, key)) {
                    const item = object[key];
                    html += `<div>${item}</div>`;
                }
            }
            return html
        },
        get_application_for: function(){
            var object = this[`get_${store_prefix}`]['application_for'];
            var html = ``;
            for (const key in object) {
                if (Object.hasOwnProperty.call(object, key)) {
                    const item = object[key];
                    html += `<div>${item}</div>`;
                }
            }
            return html
        },
        get_essay: function(){
            var object = this[`get_${store_prefix}`]['essay'];
            var html = ``;
            for (const key in object) {
                if (Object.hasOwnProperty.call(object, key)) {
                    const item = object[key];
                    html += `<div>${item}</div>`;
                }
            }
            return html
        },
        get_previous_attemped: function(){
            var object = this[`get_${store_prefix}`]['previous_attemped'];
            var html = ``;
            for (const key in object) {
                if (Object.hasOwnProperty.call(object, key)) {
                    const item = object[key];
                    if(item.module_no){
                        html += `<div>
                                    <b> &nbsp; ${item.module_no || ''} &nbsp; : </b> <br>
                                    &nbsp; ${item.date_1_center || ''} &nbsp; <br>
                                    &nbsp; ${item.date_2_center || ''} &nbsp; <br>
                                    &nbsp; ${item.date_3_center || ''} &nbsp; <br>
                                </div>`;
                    }
                }
            }
            return html
        },
        get_key: function(key){
            return this[`get_${store_prefix}`][key];
        }
    },
    computed: {
        ...mapGetters([`get_${store_prefix}`]),

    }
}
</script>

<style></style>
