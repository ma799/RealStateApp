<template>
<Filter :filters="filters" />

<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
  <Listing :listing="listing" v-for="listing in listings.data" :key="listing.id" />
</div>
  
  <div v-if="listings.data.length" class="mt-4 w-full flex justify-center ">
  <Pagination :links="listings.links" />  
  </div>
 
</template>
<script setup>
defineProps({
    'listings' : Object,
    'filters' : Object
})
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
import Pagination from '@/Component/Ui/Pagination.vue'
import Filter from '@/Pages/Listing/Index/Components/Filter.vue'

</script>