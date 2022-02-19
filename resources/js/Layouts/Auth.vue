<template>
   <div class="app">
        <flash-message/>
        <slot/>
   </div>
</template>

<script setup>
import FlashMessage from "../Components/Partials/FlashMessage.vue";
</script>
