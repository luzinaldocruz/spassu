<!-- <template>
    <div class="container mt-4">
        <h1>Relatório: Livros por Autor</h1>
        <p>Clique no botão abaixo para visualizar o relatório em PDF.</p>

        <button class="btn btn-success" @click="abrirRelatorioPdf">
            Abrir Relatório PDF
        </button>
    </div>
</template>

<script setup>
import RelatorioResource from '../api/resources/RelatorioResource';

const abrirRelatorioPdf = async () => {
    try {
        const response = await RelatorioResource.getLivrosPorAutor();
        
        // Verificar o tipo de conteúdo da resposta
        const contentType = response.headers['content-type'];
        if (!contentType || !contentType.includes('application/pdf')) {
            throw new Error('A resposta do servidor não é um PDF válido.');
        }

        // Criar um Blob para exibir o PDF
        const blob = new Blob([response.data], { type: 'application/pdf' });
        const url = window.URL.createObjectURL(blob);

        // Abrir o PDF em uma nova aba
        window.open(url, '_blank');

        // Revogar URL após 60 segundos para liberar memória
        setTimeout(() => {
            window.URL.revokeObjectURL(url);
        }, 60000);
    } catch (error) {
        console.error('Erro ao abrir o relatório:', error);
    }
};
</script> -->

<template>
    <div class="container mt-4">
        <h1>Relatório: Livros por Autor</h1>
        <p>Preencha os filtros abaixo e clique no botão para gerar o relatório em PDF.</p>

        <!-- Campos de Filtro -->
        <div class="row mb-3">
            <div class="col-md-3">
                <label class="form-label" for="titulo">Título:</label>
                <input class="form-control" v-model="filtros.Titulo" id="titulo" />
            </div>
            <div class="col-md-3">
                <label class="form-label" for="anoPublicacao">Ano de Publicação:</label>
                <input class="form-control" v-model="filtros.AnoPublicacao" id="anoPublicacao" />
            </div>
            <div class="col-md-3">
                <label class="form-label" for="codAs">Assunto:</label>
                <select class="form-select" v-model="filtros.CodAs">
                    <option value="">Selecione um assunto</option>
                    <option v-for="assunto in assuntos" :key="assunto.CodAs" :value="assunto.CodAs">
                        {{ assunto.descricao }}
                    </option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label" for="codAs">Autor:</label>
                <select class="form-select" v-model="filtros.CodAu">
                    <option value="">Selecione um autor</option>
                    <option v-for="autor in autores" :key="autor.CodAu" :value="autor.CodAu">
                        {{ autor.nome }}
                    </option>
                </select>
            </div>
        </div>

        <button class="btn btn-success" @click="abrirRelatorioPdf">
            Gerar Relatório PDF
        </button>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import RelatorioResource from '../api/resources/RelatorioResource';
import AutorResource from '../api/resources/AutorResource';
import AssuntoResource from '../api/resources/AssuntoResource';

// Filtros reativos
const filtros = ref({
    Titulo: '',
    AnoPublicacao: '',
    CodAs: [],
    CodAu: [],
    Precos: '',
});

const autores = ref([]);
const assuntos = ref([]);

const loadAutores = async () => {
    try {
        const response = await AutorResource.getAllNoPaginate();
        autores.value = response.data;
    } catch (error) {
        console.error('Erro ao carregar autores:', error);
    }
};

const loadAssuntos = async () => {
    try {
        const response = await AssuntoResource.getAllNoPaginate();
        assuntos.value = response.data;
    } catch (error) {
        console.error('Erro ao carregar assuntos:', error);
    }
};

onMounted(() => {
    loadAutores();
    loadAssuntos();
});

const abrirRelatorioPdf = async () => {
    try {
        const filters = {};
        if (filtros.value.Titulo) {
            filters['filter[Titulo]'] = filtros.value.Titulo;
        }
        if (filtros.value.AnoPublicacao) {
            filters['filter[AnoPublicacao]'] = filtros.value.AnoPublicacao;
        }
        if (filtros.value.CodAs) {
            filters['filter[CodAs]'] = filtros.value.CodAs;
        }
        if (filtros.value.CodAu) {
            filters['filter[CodAu]'] = filtros.value.CodAu;
        }
        if (filtros.value.Precos) {
            filters['filter[Precos]'] = filtros.value.Precos;
        }

        const response = await RelatorioResource.getLivrosPorAutor(filters);

        const blob = new Blob([response.data], { type: 'application/pdf' });
        const url = window.URL.createObjectURL(blob);

        const newWindow = window.open(url, '_blank');
        if (!newWindow) {
            throw new Error('O navegador bloqueou a abertura de uma nova aba. Verifique as permissões de pop-up.');
        }

        setTimeout(() => {
            window.URL.revokeObjectURL(url);
        }, 60000);
    } catch (error) {
        console.error('Erro ao abrir o relatório:', error);
        alert('Erro ao abrir o relatório.');
    }
};
</script>
