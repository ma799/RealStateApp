<template>
     <h1 class="text-3xl mb-4">Your Listings</h1>
   <section>
      <RealtorFilter :filters="filters" />
   </section>
   <section v-if="listings.data.length" class="grid grid-cols-1 lg:grid-cols-2 gap-2">
     <Box :class="{'border-dashed' : listing.deleted_at}" v-for="listing in listings.data" :key="listing.id">
       <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
         <div :class="{'opacity-30': listing.deleted_at }">
          <div
             v-if="listing.sold_at != null" 
             class="text-xs font-bold uppercase border border-dashed p-1 border-green-300 text-green-500 dark:border-green-600 dark:text-green-600 inline-block rounded-md mb-2"
           >
             sold
           </div>
           <div class="xl:flex items-end gap-2">
             <Price :price="listing.price" class="text-2xl font-medium" />
             <ListingSpace :listing="listing" />
           </div>
 
           <ListingAddress class="text-gray-700 dark:text-gray-400" :listing="listing" />
         </div>
         <section class="flex flex-col gap-2">
          <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
           <a class="btn-outline text-xs font-medium" :href="route('listing.show',listing.id)" target="_blank">Preview</a>
           <Link class="btn-outline text-xs font-medium" :href="route('realtor.listing.edit',listing.id)">Edit</Link>
           
           <Link v-if="!listing.deleted_at" class="btn-outline text-xs font-medium" 
           :href="route('realtor.listing.destroy',{'listing':listing.id})" 
           method="DELETE" >
           Delete
           </Link>

           <Link v-else class="btn-outline text-xs font-medium" 
           :href="route('realtor.listing.restore',{'listing':listing.id})" 
           method="PUT" >
           Restore
           </Link>
         </div>
         <Link class="btn-outline text-xs font-medium text-center" 
         :href="route('realtor.listing.image.create',{'listing': listing.id})">Images ({{ listing.images_count }})</Link>
         <Link class="btn-outline text-xs font-medium text-center"
          :href="route('realtor.listing.show',{'listing': listing.id})">Offers ({{ listing.offers_count }})</Link>
         </section>
       </div>
     </Box>
   </section>
   <EmptyState v-else>No listings yet</EmptyState>
   <section v-if="listings.data.length" class="w-full flex justify-center mt-10 mb-4 ">
      <Pagination :links="listings.links" />
  </section>
</template>
<script setup>
import ListingAddress from '@/Component/ListingAddress.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/Ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import RealtorFilter from '@/Pages/Realtor/Index/Component/RealtorFilter.vue';
import Pagination from '@/Component/Ui/Pagination.vue';
import EmptyState from '@/Component/Ui/EmptyState.vue';
defineProps({
    listings: Object,
    filters: Object
});
</script>
