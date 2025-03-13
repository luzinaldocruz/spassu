<template>
  <div>
    <h2>Assuntos</h2>
    <div class="table-responsive">
      <table class='table table-striped'>
        <thead class="table-light">
          <tr>
            <th>Descrição</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="assunto in assuntos" :key="assunto.CodAs">
            <td>{{ assunto.descricao }}</td>
            <td>
              <button class="btn btn-primary me-2"  @click="editAssunto(assunto.CodAs)">Editar</button>
              <button class="btn btn-danger" @click="deleteAssunto(assunto.CodAs)">Excluir</button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2">
              <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" @click="goToCreate">Criar Novo Assunto</button>
                <div class="ms-auto">
                  <PaginationList
                    v-if="pagination.links && pagination.meta"
                    :links="pagination.links"
                    :meta="pagination.meta"
                    @page-changed="loadAssuntos"
                  />
                </div>
              </div>
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import AssuntoResource from '../api/resources/AssuntoResource';
import PaginationList from './PaginationList.vue';

const assuntos = ref([]);

const pagination = ref({
  links: {},
  meta: {},
});

const router = useRouter();

const loadAssuntos = async (page = 1) => {
  try {
    const response = await AssuntoResource.getAll(page);
    assuntos.value = response.data;
    pagination.value.links = response.links;
    pagination.value.meta = response.meta;
  } catch (error) {
    console.error('Erro ao carregar assuntos:', error);
  }
};

const editAssunto = (id) => {
  router.push({ name: 'AssuntoEdit', params: { id } });
};

const deleteAssunto = async (id) => {
  if (confirm('Tem certeza que deseja excluir este assunto?')) {
    try {
      await AssuntoResource.delete(id);
      await loadAssuntos(); 
    } catch (error) {
      console.error('Erro ao excluir assunto:', error);
    }
  }
};

const goToCreate = () => {
  router.push({ name: 'AssuntoCreate' });
};

onMounted(() => {
  loadAssuntos();
});
</script>
