<template>
    <div>
        <span class="font-bold ">{{ listing.beds }}</span> 
        <span class="text-sm"> bds</span> 
        <span class="text-gray-400"> | </span> 
        <span class="font-bold ">{{ listing.baths }}</span> 
        <span class="text-sm"> ba</span> 
        <span class="text-gray-400"> | </span> 
        <span class="font-bold ">{{ listing.area }}</span> 
        <span class="text-sm"> m²</span> 
    </div>
</template>

<script setup>
  defineProps({
      'listing' : Object
   })
</script>   