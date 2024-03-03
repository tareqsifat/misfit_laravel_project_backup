<template>
    <div id="sub_category_list">
        <ul v-if="subcategories">
            <li v-for="subcategory in subcategories" :key="subcategory.id">
                <el-option :key="subcategory.id" :label="subcategory.category_name" :value="subcategory.id"></el-option>
                <sub-category-list :subcategories="subcategory.subcategory"></sub-category-list>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "SubCategoryList",
        props:['subcategories'],
    }
</script>

<style scoped>

</style>
