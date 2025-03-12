<template>
  <div>
    <h2>Livros</h2>
    <div class="table-responsive">
      <table class="table table-striped">
        <thead class="table-light">
          <tr>
            <th>Título</th>
            <th>Editora</th>
            <th>Edição</th>
            <th>Ano de Publicação</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="livro in livros" :key="livro.Codl">
            <td>{{ livro.Titulo }}</td>
            <td>{{ livro.Editora }}</td>
            <td>{{ livro.Edicao }}</td>
            <td>{{ livro.AnoPublicacao }}</td>
            <td>R$ {{ formatPreco(livro.Preco) }}</td>
            <td>
              <button class="btn btn-primary me-2" @click="editLivro(livro.Codl)">Editar</button>
              <button class="btn btn-danger" @click="deleteLivro(livro.Codl)">Excluir</button>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="6">
              <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-primary" @click="goToCreate">Criar Novo Livro</button>
                <div class="ms-auto">
                  <PaginationList
                    v-if="pagination.links && pagination.meta"
                    :links="pagination.links"
                    :meta="pagination.meta"
                    @page-changed="fetchLivros"
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
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import LivroResource from "../api/resources/LivroResource";
import PaginationList from "./PaginationList.vue"; 

const livros = ref([]);
const pagination = ref({
  links: {},
  meta: {},
});


const router = useRouter();

const fetchLivros = async (page = 1) => {
  try {
    const response = await LivroResource.getAll(page);
    livros.value = response.data;
    pagination.value.links = response.links;
    pagination.value.meta = response.meta;
  } catch (error) {
    console.error("Erro ao buscar livros:", error);
  }
};

const formatPreco = (preco) => {
  return parseFloat(preco).toFixed(2).replace(".", ",");
};


const editLivro = (id) => {
  router.push({ name: "LivroEdit", params: { id } });
};


const deleteLivro = async (id) => {
  if (confirm("Tem certeza que deseja excluir este livro?")) {
    try {
      await LivroResource.delete(id);
      await fetchLivros(); 
    } catch (error) {
      console.error("Erro ao excluir livro:", error);
    }
  }
};

const goToCreate = () => {
  router.push({ name: "LivroCreate" });
};

onMounted(() => {
  fetchLivros();
});
</script>
