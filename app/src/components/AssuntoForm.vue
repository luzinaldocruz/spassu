<template>
  <div>
    <h2>{{ isEdit ? 'Editar Assunto' : 'Criar Assunto' }}</h2>
    <form @submit.prevent="saveAssunto">
      <div class="mb-3">
        <label class="form-label" for="descricao">Descrição:</label>
        <input class="form-control" v-model="assunto.descricao" id="descricao" required />
      </div>
      <button class="btn btn-primary me-2" type="submit">Salvar</button>
      <button class="btn btn-secondary" type="button" @click="cancel">Cancelar</button>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import AssuntoResource from '../api/resources/AssuntoResource';

const assunto = ref({
  descricao: '',
});

const router = useRouter();
const route = useRoute();

const isEdit = ref(!!route.params.id);

onMounted(async () => {
  if (isEdit.value) {
    const response = await AssuntoResource.get(route.params.id);
    assunto.value = response;
  }
});

const saveAssunto = async () => {
  try {
    if (isEdit.value) {
      await AssuntoResource.update(route.params.id, assunto.value);
    } else {
      await AssuntoResource.create(assunto.value);
    }
    router.push({ name: 'Assuntos' });
  } catch (error) {
    console.log('aki', assunto.value);
    console.error('Erro ao salvar assunto:', error);
  }
};

const cancel = () => {
  router.push({ name: 'Assuntos' });
};
</script>
