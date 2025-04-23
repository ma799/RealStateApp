   <template> 
    <span>
        {{listing.street }}   {{listing.street_nb }} ,  {{listing.city}} 
    </span>
</template>
<script setup>
  defineProps({
      'listing' : Object
   })
</script>   