<template>
  <form>
    <div class="mb-4 mt-4 flex flex-wrap gap-4">
      <div class="flex flex-nowrap items-center gap-2">
        <input
          id="deleted"
          v-model="filterForm.deleted"
          type="checkbox"
          class="appearance-none h-4 w-4 rounded border border-gray-600 dark:border-gray-400 bg-white checked:bg-indigo-600 p-2 checked:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIGZpbGw9J25vbmUnIHZpZXdCb3g9JzIgLTUgMjQgMzInIHN0cm9rZS13aWR0aD0nNC41JyBjb2xvcj0nd2hpdGUnIHN0cm9rZT0nY3VycmVudENvbG9yJyA+PHBhdGggZD0nbTQuNSAxMi43NSA2IDYgMTMtMTYuNScgLz48L3N2Zz4=')] bg-no-repeat bg-center focus:ring-1 focus:ring-indigo-500"
        />
        <label for="deleted" class="text-gray-600 dark:text-gray-200">Deleted</label>
      </div>
      <section>
        <select v-model="filterForm.by" class="input-filter-l w-26">
          <option value="created_at" id="created_at">Created</option>
          <option value="price" id="price">Price</option>
        </select>
        <select v-model="filterForm.order" class="input-filter-r w-26">
          <option v-for="option in sortOptions" :key="option.value" :value="option.value">
            {{ option.label }}
          </option>
        </select>
      </section>
    </div>
  </form>
</template>

<script setup>
import { reactive, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { debounce } from 'lodash'
import { computed } from "vue";

const props = defineProps({ filters: Object });
const sortLabels = {
  created_at: [
    { label: "Latest", value: "desc" },
    { label: "Oldest", value: "asc" },
  ],

  price: [
    { label: "Pricely", value: "desc" },
    { label: "Cheapest", value: "asc" },
  ],
};

const sortOptions = computed(() => sortLabels[filterForm.by]);

const filterForm = reactive({
  deleted: props.filters.deleted ?? false,
  by: props.filters.by ?? "created_at",
  order: props.filters.order ?? "desc",
});
watch(
  filterForm,
  debounce(
    () =>
      router.get(route("realtor.listing.index"), filterForm, {
        preserveState: true,
        preserveScroll: true,
      }),
    700
  )
);
</script>
