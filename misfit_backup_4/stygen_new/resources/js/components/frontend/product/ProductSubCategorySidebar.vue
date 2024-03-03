<template>
    <ul :class="subcategories.length > 0 ? 'category-sub':''" v-if="subcategories">
        <li v-for="subcategory in subcategories" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'has-sub' : ''">
            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
            <product-sub-category-sidebar :subcategories="subcategory.subcategory"></product-sub-category-sidebar>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'ProductSubCategorySidebar',
        props:['subcategories']
    }
</script>

<style scoped>
    
</style>
