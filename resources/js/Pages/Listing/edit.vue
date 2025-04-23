<template>
    <form @submit.prevent="edit">
      <div class="grid grid-cols-6 gap-4 ">
        <div class="col-span-2">
          <label class="label">Beds</label>
          <input class="input" type="text" v-model.number="form.beds" />
          <InputError v-if="form.errors.beds" :err="form.errors.beds" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Baths</label>
          <input class="input" type="text" v-model.number="form.baths" />
          <InputError v-if="form.errors.baths" :err="form.errors.baths" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Area</label>
          <input class="input" type="text"  v-model.number="form.area"  />
          <InputError v-if="form.errors.area" :err="form.errors.area" />
        </div>
  
        <div class="col-span-4">
          <label class="label">City</label>
          <input class="input" type="text"  v-model="form.city"  />
          <InputError v-if="form.errors.city" :err="form.errors.city" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Post Code</label>
          <input class="input" type="text"  v-model="form.code"  />
          <InputError v-if="form.errors.code" :err="form.errors.code" />
        </div>
  
        <div class="col-span-4">
          <label class="label">Street</label>
          <input class="input" type="text"  v-model="form.street"  />
          <InputError v-if="form.errors.street" :err="form.errors.street" />
        </div>
  
        <div class="col-span-2">
          <label class="label">Street Nr</label>
          <input class="input" type="text"  v-model.number="form.street_nb"  />
          <InputError v-if="form.errors.street_nb" :err="form.errors.street_nb" />
        </div>
  
        <div class="col-span-6">
          <label class="label">Price</label>
          <input class="input" type="text"  v-model.number="form.price"  />
          <InputError v-if="form.errors.price" :err="form.errors.price" />
        </div>
  
        <div class="col-span-6">
          <button class="btn-primary" type="submit">edit</button>
        </div>
      </div>
    </form>
  </template>


  <script setup>
    import InputError from '@/Component/Ui/InputError.vue';
import { useForm } from '@inertiajs/vue3'
    const props = defineProps({
      listing : Object
    });
    const listing = props.listing;


    const form = useForm({
        beds:listing.beds,
        baths:listing.baths,
        area:listing.area,
        city:listing.city,
        code:listing.code,
        street:listing.street,
        street_nb:listing.street_nb,
        price:listing.price
    })

    const edit = () => form.put(route('listing.update',listing.id)) ;

  </script>





  <style scoped>
  label {
    margin-right: 2em;
  }
  
  div {
    padding: 2px
  }
  </style>