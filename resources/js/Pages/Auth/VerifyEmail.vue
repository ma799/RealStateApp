<template>
    <div>
        You have to verify your email address.</div>
    <div>
        <Link 
        :href="route('verification.send')"
        method="post"
        class="mt-2 text-sm text-indigo-600 dark:text-indigo-400 hover:underline"
        > Resend your verification email </Link>  
    </div>
</template>
<script setup>
import { Link } from '@inertiajs/vue3';
</script>