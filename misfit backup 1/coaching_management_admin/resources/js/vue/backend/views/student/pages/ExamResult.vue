<template>
    <section class="p-5">
        <div class="card list_card">
            <div class="card-header">
                <h4>Exam result</h4>
                <div class="btns">
                    <a href=""
                        @click.prevent="call_store(`set_${store_prefix}`, null), $router.push({ name: 'AllContactMessage' })"
                        class="btn rounded-pill btn-outline-warning">
                        <i class="fa fa-arrow-left me-5px"></i>
                        <span>
                            Back
                        </span>
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive pb-5 ">
                <div class="result_content">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</template>

<script>
/** store and route prefix for export object use */

export default {
    data: function () {
        return {

        }
    },
    created: function () {
    },
    methods: {

    },
    computed: {
    }
}
</script>

<style></style>
