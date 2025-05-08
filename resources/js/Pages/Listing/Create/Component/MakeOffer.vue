<template>
  <Box>
    <template #header>Make an Offer</template>
    <div class="mt-2">
      <form @submit.prevent="makeOffer">
        <input v-model.number="form.amount" type="text" class="input" />
        <input
          v-model.number="form.amount"
          type="range"
          :min="min"
          :max="max"
          step="10000"
          class="mt-2 w-full h-4 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700"
        />
        <button type="submit" :disabled="isSubmitting" class="btn-outline w-full mt-3 text-sm">
          <span v-if="isSubmitting">Processing...</span>
          <span v-else>Make an Offer</span>
        </button>
      </form>
    </div>
    <div class="flex justify-between text-gray-500 mt-3">
      <div>Difference</div>
      <div>
        <Price :price="difference" />
      </div>
    </div>
  </Box>
</template>
<script setup>
import Price from "@/Component/Price.vue";
import Box from "@/Component/Ui/Box.vue";
import { useForm } from "@inertiajs/vue3";
import { computed, watch ,ref } from "vue";
import { debounce } from "lodash";

const props = defineProps({
  listingId: Number,
  price: Number,
});
const form = useForm({
  amount: props.price,
});
const isSubmitting = ref(false); // Add this ref

const makeOffer = () =>{
if (isSubmitting.value) return; // Prevent multiple submissions
  
  isSubmitting.value = true;
  form.post(route("listing.offer.store", { listing: props.listingId }), {
    preserveScroll: true,
    preserveState: true,
    onFinish: () => {
      isSubmitting.value = false; // Re-enable button when request completes
    }
  });
}
const difference = computed(() => form.amount - props.price);
const min = Math.round(props.price / 2);
const max = Math.round(props.price * 2);

const emit = defineEmits(["updateOffer"]);

watch(
  () => form.amount,
  debounce((value) => {
    emit("updateOffer", value);
  }, 200)
);
</script>
