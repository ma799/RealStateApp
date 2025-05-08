<template>
    <form  @submit.prevent="filter">
        <div class="text-xs sm:text-sm flex items-center flex-wrap mb-5 mt-2 gap-2">
            <div class="flex flex-nowrap items-center">
               <input v-model.number="filterForm.priceFrom" class=" input-filter-l w-20 sm:w-24 md:w-28 text-xs sm:text-sm" type="text" placeholder="Price from"> 
               <input v-model.number="filterForm.priceTo" class=" input-filter-r w-20 sm:w-24 md:w-28 text-xs sm:text-sm" type="text" placeholder="Price to"> 
            </div>
            <div class="flex flex-nowrap gap-1">
               <select v-model="filterForm.beds" class=" input-filter-l w-20 sm:w-24 md:w-28 text-xs sm:text-sm">
               <option class="text-gray-400" :value="null">beds</option>
               <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
               <option >6+</option>
               </select>
               <select v-model="filterForm.baths" class=" input-filter-r w-20 sm:w-24 md:w-28 text-xs sm:text-sm">
               <option class="text-gray-400" :value="null">baths</option>
               <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
               <option >6+</option>
               </select>
            </div>
            <div class="flex flex-nowrap">
               <input v-model.number="filterForm.areaFrom" class=" input-filter-l w-20 sm:w-24 md:w-28 text-xs sm:text-sm" type="text" placeholder="Area from"> 
               <input v-model.number="filterForm.areaTo" class=" input-filter-r w-20 sm:w-24 md:w-28 text-xs sm:text-sm" type="text" placeholder="Area to"> 
            </div>
            <div class="flex flex-nowrap gap-2 ">
               <button type="submit" class="btn-normal ">Filter</button>
               <button @click="clear" type="reset">Clear</button>
            </div>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3';
const props = defineProps({
    filters : Object
})
const filterForm = useForm({
    priceFrom : props.filters.priceFrom ?? null,
    priceTo : props.filters.priceTo ?? null,
    beds : props.filters.beds ?? null,
    baths : props.filters.baths ?? null,
    areaFrom : props.filters.areaFrom ?? null,
    areaTo : props.filters.areaTo ?? null,
})

const filter = () => {
    filterForm.get(route('listing.index'),
    {
        preserveState: true,
        preserveScroll: true,
    }
    ) 
}

const clear = () => {
    filterForm.priceFrom = null,
    filterForm.priceTo = null,
    filterForm.beds = null,
    filterForm.baths = null,
    filterForm.areaFrom = null,
    filterForm.areaTo = null,
    filter()
}


</script>