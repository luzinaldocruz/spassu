<template>
    <div>
      <AssuntoForm :id="id" />
    </div>
  </template>
  
  <script setup>
  import { useRoute } from 'vue-router';
  import AssuntoForm from '../components/AssuntoForm.vue';
  
  const route = useRoute();
  const id = route.params.id;
  </script>