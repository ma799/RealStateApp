<template>
    <div class="text-red-500 dark:text-red-400 text-sm mt-1">
        {{ err }}
    </div>
</template>
<script setup>
    defineProps({
        err:String
    })
</script>
