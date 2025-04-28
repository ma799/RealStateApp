<template>
     <h1 class="text-3xl mb-4">Your Listings</h1>
   <section>
      <RealtorFilter />
   </section>
   <section class="grid grid-cols-1 lg:grid-cols-2 gap-2">
     <Box v-for="listing in listings" :key="listing.id">
       <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
         <div>
           <div class="xl:flex items-end gap-2">
             <Price :price="listing.price" class="text-2xl font-medium" />
             <ListingSpace :listing="listing" />
           </div>
 
           <ListingAddress class="text-gray-700 dark:text-gray-400" :listing="listing" />
         </div>
         <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
           <Link class="btn-outline text-xs font-medium" href="">Preview</Link>
           <Link class="btn-outline text-xs font-medium" href="">Edit</Link>
           <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.destroy',{'listing':listing.id})" method="DELETE" >Delete</Link>
         </div>
       </div>
     </Box>
   </section>
</template>
<script setup>
import ListingAddress from '@/Component/ListingAddress.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/Ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import RealtorFilter from '@/Pages/Realtor/Index/Component/RealtorFilter.vue';
defineProps({
    listings: Array
});
</script>