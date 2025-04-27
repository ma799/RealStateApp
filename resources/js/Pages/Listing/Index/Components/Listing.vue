<template>
<Box >
    <div>
      <Link :href="route('listing.show',listing.id)">
            <div class="flex items-center gap-1 ">
              <Price :price ="listing.price" class="text-2xl font-bold" />
              <div class="text-gray-400">
                <Price :price ="monthlyPayment" class="text-sm  " />
                  pm
              </div>
            </div>
            <ListingSpace :listing="listing" class="text-lg" />
            <ListingAddress :listing="listing" class="text-gray-500" />
      </Link>
     </div>
     <div>
          <Link :href="route('listing.edit',listing.id)" >edit</Link>
     </div>
</Box>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
const props = defineProps({
    'listing' : Object
})
const {monthlyPayment} = useMonthlyPayment(props.listing.price,2.5,25);
import  ListingAddress  from '@/Component/ListingAddress.vue';
import ListingSpace from '@/Component/ListingSpace.vue';
import Price from '@/Component/Price.vue';
import Box from '@/Component/Ui/Box.vue';
import {useMonthlyPayment} from '@/Composables/useMonthlyPayment';

</script>