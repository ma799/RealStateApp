<template>
  <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
    <Box v-if="listing.images.length" class="md:col-span-7 flex items-center justify-center">
      <div class="grid grid-cols-1 sm:grid-cols-2  gap-1.5">
        <div v-for="image in listing.images" class="rounded-md max-h-80">
          <img :src="image.src" class="rounded-md h-full w-full" />
        </div>
      </div>
    </Box>
      <EmptyState v-else class="text-gray-500 w-full text-center
       font-medium md:col-span-7 flex items-center justify-center" >No Image</EmptyState>
    <div class="flex flex-col md:col-span-5 gap-4">
      <Box class="">
        <template #header> Basic Info </template>
        <Price :price="listing.price" class="text-2xl font-bold" />
        <ListingSpace :listing="listing" class="text-lg" />
        <ListingAddress :listing="listing" class="text-gray-500" />
      </Box>
      <Box class="flex items-center">
        <template #header> Monthly Payment </template>
        <div class="w-full">
          <label class="label my-1">Interest rate ({{ interestRate }}%)</label>
          <input
            v-model.number="interestRate"
            type="range"
            min="0.1"
            max="30"
            step="0.1"
            class="my-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <label class="label mb-1"> ({{ duration }} years)</label>
          <input
            v-model.number="duration"
            type="range"
            min="3"
            max="35"
            step="1"
            class="my-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
          />

          <div class="text-gray-600 dark:text-gray-300 mt-2">
            <div class="text-gray-400">Your monthly payment</div>
            <Price :price="monthlyPayment" class="text-3xl" />
          </div>
          <div class="flex justify-between text-sm font-medium mt-2">
            <div class="text-gray-500">Total Paid</div>
            <div><Price :price="totalPaid" class="" /></div>
          </div>
          <div class="flex justify-between text-sm font-medium mt-2">
            <div class="text-gray-500">Princible Paid</div>
            <div><Price :price="listing.price" class="" /></div>
          </div>
          <div class="flex justify-between text-sm font-medium mt-2">
            <div class="text-gray-500">Interest Paid</div>
            <div><Price :price="totalInterest" class="" /></div>
          </div>
        </div>
      </Box>

      <MakeOffer v-if="user && !offerMade" @updateOffer="offer = $event" :listingId="listing.id" :price="listing.price" />
      <OfferMade  v-if="user && offerMade" :offer="offerMade"  />  
    </div>
  </div>
</template>
<script setup>
import { usePage } from "@inertiajs/vue3";
import { ref, computed } from "vue";
const props = defineProps({
  listing: Object,
  offerMade: Object,
});
const page = usePage();
const user = computed(() => page.props.user);
const interestRate = ref(2.5);
const duration = ref(1);
const offer = ref(props.listing.price);

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(
  offer,
  interestRate,
  duration
);

import ListingAddress from "@/Component/ListingAddress.vue";
import ListingSpace from "@/Component/ListingSpace.vue";
import Price from "@/Component/Price.vue";
import Box from "@/Component/Ui/Box.vue";
import { useMonthlyPayment } from "@/Composables/useMonthlyPayment";
import MakeOffer from "@/Pages/Listing/Create/Component/MakeOffer.vue";
import OfferMade from "@/Pages/Listing/Create/Component/OfferMade.vue";
import EmptyState from "@/Component/Ui/EmptyState.vue";
</script>
