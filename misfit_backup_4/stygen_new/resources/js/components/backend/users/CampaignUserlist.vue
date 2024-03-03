<template>
<div id="collection_list">
    <div class="add-on-show mt-5">
        <h4 class="text-center mt-2 mb-4">Campaign User Lists</h4>
        <div class="row">
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">User Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="userlist in userlists" :key="userlist.id">
                            <th scope="row"><p>{{ userlist.id }}</p></th>
                            <td><p>{{ userlist.name }}</p></td>
                            <td><p>{{ userlist.email }}</p></td>
                            <td><p>{{ userlist.phone }}</p></td>
                            <td>
                                <span v-if="userlist.is_coupon == 1" class="badge badge-info">Campaign User</span>
                                <span v-else class="badge badge-primary">Normal User</span>
                            </td>
                            <!-- <td><button type="button" @click.prevent="deleteAddon" class="btn btn-warning">delete</button></td> -->
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</template>
<script>
import $ from 'jquery'
export default {
    name: "CollectionList",
    data() {
        return {
            value: [],
            length: 4,
            product: '',
            keyword: '',
            userlists: []
        }
    },
    computed: {
        // getlowstockproduct() {
        //     return this.$store.getters['aproduct/getlowstockproduct'];
        // }
    },
    methods: {
        getUsers() {
            axios.get('/admin/campaign-userlist')
            .then((res) => {
                console.log(res.data);
                this.userlists = res.data.user_data
            })
        },
        // getlowstockproduct() {
        //     this.$store.dispatch('aproduct/getlowstockproduct')
        // }
    },
    created() {
        this.getUsers()
    }


}
</script>
