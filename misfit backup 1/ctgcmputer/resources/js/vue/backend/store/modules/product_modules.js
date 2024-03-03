import StoreModule from "./schema/StoreModule";

let test_module = new StoreModule('product','product','Product');
const {store_prefix, api_prefix, route_prefix} = test_module;

// state list
const state = {
    ...test_module.states(),
    [`${store_prefix}_specification`]: null,
    [`${store_prefix}_description`]: null,
    [`${store_prefix}_short_description`]: null,
    [`orderByAsc`]: false,
};

// get state
const getters = {
    ...test_module.getters(),
    [`get_${store_prefix}_specification`]: (state)=> state[`${store_prefix}_specification`],
    [`get_${store_prefix}_description`]: (state)=> state[`${store_prefix}_description`],
    [`get_${store_prefix}_short_description`]: (state)=> state[`${store_prefix}_short_description`],
};

// actions

const actions = {
    ...test_module.actions(),

    [`fetch_${store_prefix}`]: async function ({ state, commit }, { id }) {
        let url = `/${api_prefix}/${id}`;
        await axios.get(url).then((res) => {
            this.commit(`set_${store_prefix}`, res.data);

            var images=[];
            for (let i = 0; i < res.data.related_images.length; i++) {
                let el = res.data.related_images[i];
                images.push(`
                    <img src="/${el.image}"/>
                    <span onclick="remove_product_image(event, ${el.id})" class="text-danger cursor-pointer">remove</span>
                `);
            }
            setTimeout(() => {
                var file_previews = document.querySelectorAll('.file_preview');
                [...file_previews].forEach((i,index)=>{
                    i.innerHTML = images[index] || ''
                })
            }, 1000);

            res.data.categories?.forEach((i) => {
                commit(`set_selected_categorys`, i);
            })

            commit(`set_selected_brands`, res.data.brand);
        });
    },

    [`store_${store_prefix}`]: function({state, getters, commit}){
        const {form_values, form_inputs, form_data} = window.get_form_data(`.create_form`);
        // console.log(form_data, form_inputs, form_values);
        const {get_category_selected: category, get_brand_selected: brand} = getters;

        category.forEach((i)=> {
            form_data.append('selected_categories[]',i.id);
        });
        form_data.append('brand_id',brand[0].id);

        // console.log(form_data);
        form_data.append("specification", state[`${store_prefix}_specification`]);
        form_data.append("description", state[`${store_prefix}_description`]);
        form_data.append("short_description", state[`${store_prefix}_short_description`]);
        axios.post(`/${api_prefix}/store`,form_data)
            .then(res=>{
                window.s_alert(`new ${store_prefix} has been created`);
                $(`${store_prefix}_create_form input`).val('');
                commit(`set_clear_selected_products`,false);
                commit(`set_clear_selected_suppliers`,false);
                management_router.push({name:`All${route_prefix}`})
            })
            .catch(error=>{

            })
    },

    [`update_${store_prefix}`]: function ({ state, getters, commit }, event) {
        const {form_values, form_inputs, form_data} = window.get_form_data(`.update_form`);
        const {get_category_selected: category, get_brand_selected: brand} = getters;

        category.forEach((i)=> {
            form_data.append('selected_categories[]',i.id);
        });
        form_data.append('brand_id',brand[0].id);
        form_data.append("id", state[store_prefix].id);
        form_data.append("specification", state[`${store_prefix}_specification`]);
        form_data.append("description", state[`${store_prefix}_description`]);
        form_data.append("short_description", state[`${store_prefix}_short_description`]);

        axios.post(`/${api_prefix}/update`, form_data).then((res) => {
            /** reset loaded user_role after data update */
            // this.commit(`set_${store_prefix}`, null);
            window.s_alert("data updated");
        });
    },

    [`is_top_product_${store_prefix}`]: function ({ state, getters, commit },{event,id}) {
        let form_data = {
            id: id,
            is_top_product: event.target.checked,
        }

        axios.post(`/${api_prefix}/update-is-top-product`, form_data).then((res) => {
            window.s_alert("data updated");
        });
    },
}

// mutators
// console.log(test_module.mutations());
const mutations = {
    ...test_module.mutations(),
    [`set_${store_prefix}_specification`]: function(state, data){
        state[`${store_prefix}_specification`] = data;
    },
    [`set_${store_prefix}_description`]: function(state, data){
        state[`${store_prefix}_description`] = data;
    },
    [`set_${store_prefix}_short_description`]: function(state, data){
        state[`${store_prefix}_short_description`] = data;
    },
};


export default {
    state,
    getters,
    actions,
    mutations,
};
