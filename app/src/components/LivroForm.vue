<template>
    <div>
        <div v-if="Object.keys(errors).length" class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Erro ao salvar:</strong>
            <ul>
                <li v-for="(messages, field) in errors" :key="field">
                    {{ messages[0] }}
                </li>
            </ul>
        </div>
 
      <h2>{{ isEdit ? 'Editar Livro' : 'Criar Livro' }}</h2>
      <form @submit.prevent="saveLivro">
        <div class="mb-3">
          <label class="form-label" for="titulo">Título:</label>
          <input class="form-control" v-model="livro.Titulo" id="titulo" required />
        </div>
        
        <div class="row">
          <div class="col-md-3 mb-3">
            <label class="form-label" for="editora">Editora:</label>
            <input class="form-control" v-model="livro.Editora" id="editora" required />
          </div>
          
          <div class="col-md-3 mb-3">
            <label class="form-label" for="edicao">Edição:</label>
            <input class="form-control" v-model="livro.Edicao" id="edicao" type="number" required />
          </div>
          
          <div class="col-md-3 mb-3">
            <label class="form-label" for="anoPublicacao">Ano de Publicação:</label>
            <input class="form-control" v-model="livro.AnoPublicacao" id="anoPublicacao" required />
          </div>
          
          <div class="col-md-3 mb-3">
            <label class="form-label" for="preco">Preço:</label>
            <div class="input-group">
                <span class="input-group-text">R$</span>
                <input class="form-control" v-model.lazy="formattedPreco" id="preco" type="text" required @blur="formatPreco" />
            </div>
          </div>
           

        </div>
          
          <div class="row mb-3">
              <div class="col-md-6">
                  <label class="form-label" for="autores-disponiveis">Adicionar Autor:</label>
                  <div class="input-group">
                      <select class="form-select" v-model="autorSelecionado">
                          <option v-for="autor in autoresDisponiveis" :key="autor.CodAu" :value="autor.CodAu">
                              {{ autor.nome }}
                            </option>
                        </select>
                        <button type="button" class="btn btn-success" @click="adicionarAutor(autorSelecionado)">Adicionar</button>
                    </div>
                </div>  
                <div class="col-md-6">
                    <label class="form-label" for="assuntos-disponiveis">Adicionar Assunto:</label>
                    <div class="input-group">
                        <select class="form-select" v-model="assuntoSelecionado">
                            <option v-for="assunto in assuntosDisponiveis" :key="assunto.CodAs" :value="assunto.CodAs">
                                {{ assunto.Descricao }}
                            </option>
                        </select>
                        <button type="button" class="btn btn-success" @click="adicionarAssunto(assuntoSelecionado)">Adicionar</button>
                    </div>
                </div>
            </div> 
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <div class="table-responsive border p-2 rounded">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="autor in autoresSelecionados" :key="autor">
                    <td>{{ getAutorNome(autor) }}</td>
                    <td>
                      <button type="button" class="btn btn-danger btn-sm" @click="removerAutor(autor)">Remover</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          
          <div class="col-md-6 mb-3">
            <div class="table-responsive border p-2 rounded">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Descrição</th>
                    <th>Ações</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="assunto in assuntosSelecionados" :key="assunto">
                    <td>{{ getAssuntoNome(assunto) }}</td>
                    <td>
                      <button type="button" class="btn btn-danger btn-sm" @click="removerAssunto(assunto)">Remover</button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <button class="btn btn-primary me-2" type="submit">Salvar</button>
        <button class="btn btn-secondary" type="button" @click="cancel">Cancelar</button>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue';
  import { useRouter, useRoute } from 'vue-router';
  import LivroResource from '../api/resources/LivroResource';
  import AutorResource from '../api/resources/AutorResource';
  import AssuntoResource from '../api/resources/AssuntoResource';
  
  const livro = ref({
    Titulo: '',
    Editora: '',
    Edicao: '',
    AnoPublicacao: '',
    Preco: '',
    autores: [],
    assuntos: [],
  });
  
  const autoresSelecionados = ref([]);
  const todosAutores = ref([]);
  const assuntosSelecionados = ref([]);
  const todosAssuntos = ref([]);
  const errors = ref({});

  const router = useRouter();
  const route = useRoute();
  const isEdit = ref(!!route.params.id);
  
  const loadAutores = async () => {
    try {
      const response = await AutorResource.getAllNoPaginate();
      todosAutores.value = response.data;
    } catch (error) {
      console.error('Erro ao carregar autores:', error);
    }
  };

  const loadAssuntos = async () => {
    try {
      const response = await AssuntoResource.getAllNoPaginate();
      todosAssuntos.value = response.data;
    } catch (error) {
      console.error('Erro ao carregar assuntos:', error);
    }
  };
  
  onMounted(async () => {
    loadAutores();
    loadAssuntos();
    if (isEdit.value) {
        const response = await LivroResource.get(route.params.id);
        livro.value = response;
        autoresSelecionados.value = livro.value.Autores.map(a => a.CodAu);
        assuntosSelecionados.value = livro.value.Assuntos.map(a => a.CodAs);
    }
  });
  
  const autoresDisponiveis = computed(() => {
    return todosAutores.value.filter(autor => !autoresSelecionados.value.includes(autor.CodAu));
  });

  const assuntosDisponiveis = computed(() => {
    return todosAssuntos.value.filter(assunto => !assuntosSelecionados.value.includes(assunto.CodAs));
  });
  
  
  const getAutorNome = (id) => {
    const autor = todosAutores.value.find(a => a.CodAu === id);
    return autor ? autor.nome : 'Desconhecido';
  };

  const getAssuntoNome = (id) => {
    const assunto = todosAssuntos.value.find(a => a.CodAs === id);
    return assunto ? assunto.Descricao : 'Desconhecido';
  };
  
  const adicionarAutor = (CodAu) => {
    if (!autoresSelecionados.value.includes(CodAu)) {
      autoresSelecionados.value.push(CodAu);
    }
  };
  
  const adicionarAssunto = (CodAs) => {
  if (!assuntosSelecionados.value.includes(CodAs)) {
    assuntosSelecionados.value.push(CodAs);
  }
};
  const removerAutor = (CodAu) => {
    autoresSelecionados.value = autoresSelecionados.value.filter(a => a !== CodAu);
  };


const removerAssunto = (CodAs) => {
  assuntosSelecionados.value = assuntosSelecionados.value.filter(a => a !== CodAs);
};
  
const saveLivro = async () => {
    errors.value = {};
    try {
        livro.value.autores = [...autoresSelecionados.value];
        livro.value.assuntos = [...assuntosSelecionados.value];

        if (isEdit.value) {
            await LivroResource.update(route.params.id, livro.value);
        } else {
            await LivroResource.create(livro.value);
        }
        router.push({ name: 'Livros' });
    } catch (error) {
        if (error.response && error.response.data && error.response.data.errors) {
            errors.value = error.response.data.errors;
        }
        console.error('Erro ao salvar livro:', error);
    }
};
  
  const cancel = () => {
    router.push({ name: 'Livros' });
  };

  const formattedPreco = computed({
  get() {
    return livro.value.Preco ? parseFloat(livro.value.Preco).toFixed(2).replace('.', ',') : '';
  },
  set(value) {
    const numericValue = value.replace(/\D/g, '');
    if (numericValue) {
      livro.value.Preco = (parseFloat(numericValue) / 100).toFixed(2);
    } else {
      livro.value.Preco = '';
    }
  }
});

const formatPreco = () => {
  if (livro.value.Preco) {
    livro.value.Preco = parseFloat(livro.value.Preco).toFixed(2);
  }
};
</script>
