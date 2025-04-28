<template>
    <form>
      <div class="mb-4 mt-4 flex flex-wrap gap-2">
        <div class="flex flex-nowrap items-center gap-2">
          <input
            id="deleted"
            v-model="filterForm.deleted"
            type="checkbox"
            class=" 
            appearance-none h-4 w-4 rounded border border-gray-300 dark:border-gray-400 bg-white 
            checked:bg-indigo-600 
            p-2
            checked:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0naHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmcnIGZpbGw9J25vbmUnIHZpZXdCb3g9JzIgLTUgMjQgMzInIHN0cm9rZS13aWR0aD0nNC41JyBjb2xvcj0nd2hpdGUnIHN0cm9rZT0nY3VycmVudENvbG9yJyA+PHBhdGggZD0nbTQuNSAxMi43NSA2IDYgMTMtMTYuNScgLz48L3N2Zz4=')]
            bg-no-repeat bg-center
            focus:ring-1 focus:ring-indigo-500 
             "
          />
          <label for="deleted" class=" text-gray-200">Deleted</label>
        </div>
      </div>
    </form>
  </template>
  
  <script setup>
  import { useForm } from '@inertiajs/vue3'
  
  const filterForm = useForm({
    deleted: false,
  })
  </script>
