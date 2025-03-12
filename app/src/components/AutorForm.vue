<template>
    <div>
      <h2>{{ isEdit ? 'Editar Autor' : 'Criar Autor' }}</h2>
      <form @submit.prevent="saveAutor">
        <div class="mb-3">
          <label class="form-label" for="nome">Nome:</label>
          <input class="form-control" v-model="autor.nome" id="nome" required />
        </div>
        <button class="btn btn-primary me-2" type="submit">Salvar</button>
        <button class="btn btn-secondary" type="button" @click="cancel">Cancelar</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  import AutorResource from '../api/resources/AutorResource';
  

  const autor = ref({
    nome: '',
  });
  

  const router = useRouter();
  const route = useRoute();

  const isEdit = ref(!!route.params.id);
  
  onMounted(async () => {
    if (isEdit.value) {
      const response = await AutorResource.get(route.params.id);
      autor.value = response;
    }
  });
  

  const saveAutor = async () => {
    try {
      if (isEdit.value) {
        await AutorResource.update(route.params.id, autor.value);
      } else {
        await AutorResource.create(autor.value);
      }
      router.push({ name: 'Autores' });
    } catch (error) {
      console.error('Erro ao salvar autor:', error);
    }
  };
  

  const cancel = () => {
    router.push({ name: 'Autores' });
  };
  </script>
  