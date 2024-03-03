<template>
   <ul :class="subcategories.length > 0 ? 'cat-dropdown list-group':''" v-if="subcategories">
        <li v-for="subcategory in subcategories" :key="subcategory.id" :class="subcategory.subcategory.length > 0 ? 'right-menu list-group-item' : ''">
            <router-link :to="{name: 'subCategoryProduct', params: {catSlug:subcategory.cat_slug}}">{{ subcategory.category_name }}</router-link>
            <header-category-list :subcategories="subcategory.subcategory"></header-category-list>
        </li>
    </ul>
</template>

<script>
    export default {
        name: "HeaderCategoryList",
        props:['subcategories'],
    }
</script>

<style scoped>

</style>
