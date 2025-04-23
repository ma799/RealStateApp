<!-------------------------------------------------------------------TEMPLATE----------------------------------------------------------------- -->
<template>
<!-------------------------------------------------------------------HEADER----------------------------------------------------------------- -->
<header class="border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900 w-full">
   
<div class="container max-w-10/10 mx-auto">
<nav class="flex p-4 justify-between items-center">
<div class="font-medium text-lg"><Link :href="route('listing.index')" >Listing</Link></div>
<div class="text-indigo-600 dark:text-indigo-300 text-xl font-bold text-center "><Link :href="route('listing.index')" >Larazillow</Link></div>
<div v-if="user" class="flex items-center gap-4">
<div class="text-sm text-gray-500 dark:text-gray-400">{{user.name}}</div>
<div class="btn-primary"><Link :href="route('listing.create')" >+ New Listing</Link></div>
 <Link :href="route('logout')" method="DELETE">Log out</Link>
</div>
<div v-else class="flex items-center gap-3">
    <Link :href="route('user-account.create')">Register</Link>
    <Link :href="route('login')">sign in</Link>
</div>
</nav>
</div>

</header>   
<!-------------------------------------------------------------------/HEADER----------------------------------------------------------------- -->
<!-------------------------------------------------------------------MAIN----------------------------------------------------------------- -->
<main class="container mx-auto p-4 ">

    <div v-if=" success " class="border-2 dark:border-green-700 bg-green-50 dark:bg-green-900 p-2 border-green-200 shadow-sm mb-4 rounded-md">
       {{ success }}
       This is Flash !
    </div>
    <slot>Default</slot>

</main>
<!-------------------------------------------------------------------/MAIN----------------------------------------------------------------- -->
</template>
<!-------------------------------------------------------------------/TEMPLATE----------------------------------------------------------------- -->












<!-------------------------------------------------------------------SCRIPT----------------------------------------------------------------- -->
<script setup>
    import { Link } from '@inertiajs/vue3';
    import { usePage } from '@inertiajs/vue3';
    import { computed } from 'vue';

    const page = usePage();
    const success = computed(()=>page.props.flash.success);
    const user = computed(()=>page.props.user);
</script>
