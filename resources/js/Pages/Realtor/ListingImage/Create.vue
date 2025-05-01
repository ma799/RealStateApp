<template>
    <Box>
        <template #header>Upload Images</template>
        <form @submit.prevent="upload" >
            <section class="flex gap-2 items-center px-2 py-4">
                <input type="file" multiple @input="addFiles" 
                class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700
                 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium
                  file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4
                " />
                <button  class="btn-outline disabled:opacity-30 disabled:cursor-not-allowed" type="submit" :disabled="canUpload">Upload</button>
                <button class="btn-outline" @click="reset" type="reset">Reset</button>
            </section>
            <div v-if="imageErrors.length">
                <InputError v-for="(error,index) in imageErrors" :key="index" :err="error" />  
            </div>  
        </form>
    </Box>
    <Box class="mt-4" v-if="listing.images.length" >
        <template #header>Current Uploaded Images</template>
        <section class="grid grid-cols-2 md:grid-cols-3 gap-2 md:gap-4 mt-4">
            <div v-for="image in listing.images" :key="image.id" class="rounded-md flex flex-col justify-between max-h-90 g-2">
                     <img :src="image.src" class="rounded-md h-10/12 w-full"  />
                     <Link method="DELETE" :href="route('realtor.listing.image.destroy',{listing: listing.id , image : image})"
                       class="btn-outline text-xs font-medium text-center">Delete</Link>
            </div>
        </section>
    </Box>
</template>


<script setup>
import Box from '@/Component/Ui/Box.vue';
import { Link } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { router } from '@inertiajs/vue3'    
import NProgress from 'nprogress' 
import InputError from '@/Component/Ui/InputError.vue';


const props = defineProps({
    listing:Object,
})

const form = useForm({
    images: [],
});
const imageErrors = computed(() => Object.values(form.errors) )
const upload = () => {
    NProgress.start();
    form.post(route('realtor.listing.image.store', { listing: props.listing.id }), {
        onSuccess: () => {
            form.reset('images');
            reset();
            NProgress.done();
        },
        onError: () => NProgress.done()
    });
};

const canUpload = computed(() => form.images.length === 0);

const addFiles = (event) => {
    form.images = Array.from(event.target.files);
};

const reset = () => {
    form.reset('images');
};



// Initialize NProgress with custom settings
NProgress.configure({
    minimum: 0.1,
    easing: 'ease',
    speed: 500,
    showSpinner: false,
    trickle: false,
    template: `
        <div class="progress-bar" role="bar">
            <div class="progress-peg"></div>
        </div>
    `
});

router.on('progress', (event) => {
    if (event.detail?.progress?.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9);
    }
});
</script>

<style>
/* Custom NProgress styles */
.progress-bar {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, #4f46e5, #7c3aed);
    z-index: 9999;
    transition: width 0.3s ease;
}

.progress-peg {
    position: absolute;
    right: 0;
    width: 100px;
    height: 100%;
    opacity: 1;
    transform: rotate(3deg) translate(0px, -2px);
    box-shadow: 0 0 10px #4f46e5, 0 0 5px #4f46e5;
}
</style>