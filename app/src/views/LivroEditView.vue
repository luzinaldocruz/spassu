<template>
    <div>
      <LivroForm :id="id" />
    </div>
  </template>
  
  <script setup>
  import { useRoute } from 'vue-router';
  import LivroForm from '../components/LivroForm.vue';
  
  const route = useRoute();
  const id = route.params.id;
  </script>