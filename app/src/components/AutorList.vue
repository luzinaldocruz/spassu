<template>
    <div>
      <h2>Autores</h2>
      <div class="table-responsive">
        <table class='table table-striped'>
          <thead class="table-light">
            <tr>
              <th>Nome</th>
              <th>Ações</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="autor in autores" :key="autor.CodAu">
              <td>{{ autor.nome }}</td>
              <td>
                <button class="btn btn-primary me-2"  @click="editAutor(autor.CodAu)">Editar</button>
                <button class="btn btn-danger" @click="deleteAutor(autor.CodAu)">Excluir</button>
              </td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="2">
                <div class="d-flex justify-content-between align-items-center">
                  <button class="btn btn-primary" @click="goToCreate">Criar Novo Autor</button>
                  <div class="ms-auto">
                    <PaginationList
                      v-if="pagination.links && pagination.meta"
                      :links="pagination.links"
                      :meta="pagination.meta"
                      @page-changed="loadAutores"
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
  import AutorResource from '../api/resources/AutorResource';
  import PaginationList from './PaginationList.vue';
  
  const autores = ref([]);

  const pagination = ref({
  links: {},
  meta: {},
  });
  
  const router = useRouter();
  
  const loadAutores = async (page = 1) => {
    try {
      const response = await AutorResource.getAll(page);
      autores.value = response.data;
      pagination.value.links = response.links;
      pagination.value.meta = response.meta;
    } catch (error) {
      console.error('Erro ao carregar autores:', error);
    }
  };
  
  const editAutor = (id) => {
    router.push({ name: 'AutorEdit', params: { id } });
  };

  const deleteAutor = async (id) => {
    if (confirm('Tem certeza que deseja excluir este autor?')) {
      try {
        await AutorResource.delete(id);
        await loadAutores();
      } catch (error) {
        console.error('Erro ao excluir autor:', error);
      }
    }
  };
  
  const goToCreate = () => {
    router.push({ name: 'AutorCreate' });
  };

  onMounted(() => {
    loadAutores();
  });
  </script>
  