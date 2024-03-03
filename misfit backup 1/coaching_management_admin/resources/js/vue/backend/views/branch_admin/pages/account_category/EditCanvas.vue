<template>
    <div class="canvas_backdrop"
        :class="{active: this[`get_${store_prefix}_show_edit_canvas`]}"
        @click="$event.target.classList.contains('canvas_backdrop') && call_store(`set_${store_prefix}_show_edit_canvas`,(false))">
        <div class="content right" v-if="this[`get_${store_prefix}_show_edit_canvas`]">
            <div class="content_header">
                <h3 class="offcanvas-title">Edit Category</h3>
                <i @click="call_store(`set_${store_prefix}_show_edit_canvas`,(false))" class="fa fa-times"></i>
            </div>
            <div :class="`cotent_body ${store_prefix}_canvas_edit_form`" @keyup.enter="call_store(`upload_${store_prefix}_edit_canvas_input`)">
                
                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                    <input-field
                        :label="`Name`"
                        :value="get_store(`get_${store_prefix}`,`title`)"
                        :data_attr="[{name: 'title'}]"
                    />
                </div>
                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" :data_attr="[{name: 'description'}]" :value="get_store(`get_${store_prefix}`,`description`)"></textarea>
                </div>
                
                <div class=" form-group d-grid align-content-start gap-1 mb-2 " >
                    <label for="is_visible">Select visibility</label>
                    <select class="form-select" :value="get_store(`get_${store_prefix}`,`is_visible`)" :data_attr="[{name: 'is_visible'}]" name="is_visible" id="is_visible">
                        <option value="1">Visible</option>
                        <option value="0">Not Visible</option>
                    </select>
                </div>

                <div class=" form-group text-center mb-2 " >
                    <button @click.prevent="call_store(`upload_${store_prefix}_edit_canvas_input`)" type="button" class="btn btn-outline-info">Submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapActions, mapGetters, mapMutations } from 'vuex'
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
        }
    },
    methods: {
        ...mapActions([`upload_${store_prefix}_edit_canvas_input`]),
        ...mapMutations([
            `set_${store_prefix}_show_edit_canvas`,
        ]),

        call_store: function(name, params=null){
            this[name](params)
        },

        get_store: function(name, params=null){
            return this[name][params]
        },

    },
    computed: {
        ...mapGetters([
            `get_${store_prefix}_show_edit_canvas`,
            `get_${store_prefix}`,
        ])
    }
}
</script>

<style>

</style>
