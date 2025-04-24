<template>
    <form >
        <div class="flex items-center flex-wrap mb-5 mt-2 gap-2">
            <div class="flex flex-nowrap items-center">
               <input class=" input-filter-l w-28" type="text" placeholder="Price from"> 
               <input class=" input-filter-r w-28" type="text" placeholder="Price to"> 
            </div>
            <div class="flex flex-nowrap gap-1">
               <select class=" input-filter-l w-28">
               <option class="text-gray-400" :value="null">beds</option>
               <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
               <option >6+</option>
               </select>
               <select class=" input-filter-r w-28">
               <option class="text-gray-400" :value="null">baths</option>
               <option v-for="n in 5" :value="n" :key="n">{{ n }}</option>
               <option >6+</option>
               </select>
            </div>
            <div class="flex flex-nowrap">
               <input class=" input-filter-l w-28" type="text" placeholder="Area from"> 
               <input class=" input-filter-r w-28" type="text" placeholder="Area to"> 
            </div>
            <div class="flex flex-nowrap gap-2">
               <button type="submit" class="btn-normal">Filter</button>
               <button type="reset">Clear</button>
            </div>
        </div>
    </form>
</template>