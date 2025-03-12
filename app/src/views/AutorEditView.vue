<template>
    <div>
      <AutorForm :id="id" />
    </div>
  </template>
  
  <script setup>
  import { useRoute } from 'vue-router';
  import AutorForm from '../components/AutorForm.vue';
  
  const route = useRoute();
  const id = route.params.id;
  </script>