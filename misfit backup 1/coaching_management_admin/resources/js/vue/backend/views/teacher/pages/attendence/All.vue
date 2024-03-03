<template>
    <div class="conatiner">
        <div class="card list_card">
            <div class="card-header">
                <h4>
                    All
                    <small v-if="this[`get_${store_prefix}_selected`].length">
                        &nbsp; selected:
                        <b class="text-warning">
                            {{ this[`get_${store_prefix}_selected`].length }}
                        </b>
                        &nbsp;
                        <b @click="call_store(`set_clear_selected_${store_prefix}s`, true)" class="text-danger cursor-pointer">clear</b>
                        &nbsp;
                        <b @click="call_store(`set_${store_prefix}_show_selected`,true)" class="text-success cursor-pointer">show</b>
                    </small>
                </h4>

                

                
                <div class="btns d-flex gap-2 align-items-center">
                    <!-- <permission-button
                        :permission="'can_create'"
                        :to="{name: `Create${route_prefix}`}"
                        :classList="'btn rounded-pill btn-outline-info'">
                        <i class="fa fa-pencil me-5px"></i>
                        Create
                    </permission-button> -->
                </div>
            </div>
            <div class="table-responsive card-body text-nowrap">
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr>
                            <!-- <th><input @click="call_store(`set_select_all_${store_prefix}s`)" type="checkbox" class="form-check-input check_all"></th> -->
                            <table-th :sort="true" :tkey="'id'" :title="'ID'" :ariaLable="'id'"/>
                            <table-th :sort="true" :tkey="'name'" :title="'Name'" />
                            <table-th :sort="true" :tkey="'Date'" :title="'Date'" />
                            <table-th :sort="true" :tkey="'start_time'" :title="'start time'" />
                            <table-th :sort="true" :tkey="'end_time'" :title="'end time'" />
                            <!-- <th aria-label="actions">Present</th> -->
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr v-for="(item, index) in get_single_teacher_attendence" :key="index">
                            
                            <td>{{ index+1 }}</td>
                            
                            <td>
                                <span class="text-warning cursor_pointer" @click.prevent="call_store(`set_${store_prefix}`,item)">
                                    {{ item.user.first_name }} {{ item.user.last_name }}
                                </span>
                            </td>
                            
                            <td>
                                <span v-if="item.date">
                                    {{ new Date(item.date).toDateString()  }},
                                </span>
                            </td>

                            <td>
                                <span>
                                    {{ item.start_time }}
                                </span>
                            </td>

                            <td>
                                <span>
                                    {{ item.end_time }}
                                </span>
                            </td>
                    
                            <!-- <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" v-if="item.present == 1" checked @change="process_attendence(item.id, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <input class="form-check-input" v-else @change="process_attendence(item.id, $event)" type="checkbox" role="switch" :id="`SwitchPresent${item.id}`">
                                    <label class="form-check-label" :for="`SwitchPresent${item.id}`">Present</label>
                                </div>
                            </td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- <details-canvas/>
        <selected-canvas/> -->
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex';
import PermissionButton from '../../../components/PermissionButton.vue';
import TableTh from './components/TableTh.vue';
// import DetailsCanvas from './DetailsCanvas.vue';
// import SelectedCanvas from './SelectedCanvas.vue';

/** store and route prefix for export object use */
import PageSetup from './PageSetup';
const {route_prefix, store_prefix} = PageSetup;

export default {
    components: { PermissionButton, TableTh },
    data: function(){
        return {
            store_prefix,
            route_prefix,
        }
    },
    created: function(){
        this.fetch_single_teacher_attendence();
    },
    
    methods: {
        ...mapActions([
            `soft_delete_${store_prefix}`,
            `delete_${store_prefix}`,
            `restore_${store_prefix}`,
            `export_${store_prefix}_all`,
            `export_selected_${store_prefix}_csv`,
            `fetch_single_teacher_attendence`
        ]),
        ...mapMutations([
            `set_${store_prefix}_paginate`,
            `set_${store_prefix}_page`,
            `set_${store_prefix}_search_key`,
            `set_${store_prefix}_orderByCol`,
            `set_${store_prefix}_show_active_data`,
            `set_${store_prefix}`,
            `set_selected_${store_prefix}s`,
            `set_select_all_${store_prefix}s`,
            `set_clear_selected_${store_prefix}s`,
            `set_${store_prefix}_show_selected`,
        ]),
        call_store: function(name, params=null){
            this[name](params)
        },

        handle_pagination: function(page=1){
            return this[`set_${store_prefix}_page`](page);
        },

        check_if_data_is_selected: function(user){
            let check_index = this[`get_${store_prefix}_selected`].findIndex((i) => i.id == user.id);
            if(check_index >= 0){
                return true;
            }else{
                return false;
            }
        },
    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}s`,
            `get_single_teacher_attendence`,
            `get_${store_prefix}_selected`,
            `get_${store_prefix}_show_active_data`,
        ]),
    }
}
</script>

<style>

</style>

