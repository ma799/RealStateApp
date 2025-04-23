<template>
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
  <Listing :listing="listing" v-for="listing in listings" :key="listing.id" />
</div>
</template>
<script setup>
defineProps({
    'listings' : Array
})
import Listing from '@/Pages/Listing/Index/Components/Listing.vue'
</script>