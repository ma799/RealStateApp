<template>
  <Box>
    <template #header
      >Offer #{{ offer.id }}
      <span
        v-if="offer.accepted_at"
        class="dark:bg-green-900 dark:text-green-200 bg-green-200 text-green-900 p-1 rounded-md uppercase ml-1"
      >
        accepeted</span
      ></template
    >
    <section class="flex items-center justify-between">
      <div>
        <Price :price="offer.amount" class="text-xl" />
        <div class="text-gray-500">Difference <Price :price="difference" /></div>
        <div class="text-gray-500 text-sm">Made by {{ offer.bidder.name }}</div>
        <div class="text-gray-500 text-sm">Made on {{ madeOn }}</div>
      </div>
      <div>
        <Link
          class="btn-outline text-xs font-medium"
          v-if="!props.listingSoldAt"
          method="put"
          as="button"
          :href="route('realtor.offer.accept', { offer: offer.id })"
        >
          Accept
        </Link>
      </div>
    </section>
  </Box>
</template>
<script setup>
import Price from "@/Component/Price.vue";
import Box from "@/Component/Ui/Box.vue";
import { Link } from "@inertiajs/vue3";
import { computed } from "vue";

const props = defineProps({
  offer: Object,
  listingPrice: Number,
  listingSoldAt: String,
});
const difference = computed(() => props.offer.amount - props.listingPrice);
const madeOn = computed(() => new Date(props.offer.created_at).toDateString());
</script>
