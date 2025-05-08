<template>
    <form @submit.prevent="login">
        <div class="px-1 sm:px-0 w-5/5 sm:w-4/5 md:w-4/5 lg:w-1/2  mx-auto flex flex-col gap-4">
            <div>
                <label for="email" class="label">E-mail (user name)</label>
                <input type="text" v-model="form.email" id="email" class="input">
                <InputError :err="form.errors.email" v-if="form.errors.email" />
            </div>
            <div>
                <label for="password" class="label">Password</label>
                <input type="password" v-model="form.password"  id="password" class="input">
                <InputError :err="form.errors.password" v-if="form.errors.password" />
            </div>
            <div>
                <button type="submit" class="btn-primary w-full mt-2 ">Log in</button>
            </div>
            <div>
                <Link :href="route('user-account.create')" class=" text-center text-gray-500 mt-2 ">Don't have an account ? Click here</Link>
            </div>
        </div>
    </form>
</template>

<script setup>
import InputError from '@/Component/Ui/InputError.vue';
import { Link, useForm } from '@inertiajs/vue3';
const form = useForm({
    email : null,
    password : null,
})
const login = () => form.post(route('login.store'))
</script>