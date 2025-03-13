import { createRouter, createWebHistory } from 'vue-router';

import AutoresView from '../views/AutoresView.vue';
import AutorCreateView from '../views/AutorCreateView.vue';
import AutorEditView from '../views/AutorEditView.vue';

import AssuntosView from '../views/AssuntosView.vue';
import AssuntoCreateView from '../views/AssuntoCreateView.vue';
import AssuntoEditView from '../views/AssuntoEditView.vue';

import LivrosView from '../views/LivrosView.vue';
import LivroCreateView from '../views/LivroCreateView.vue';
import LivroEditView from '../views/LivroEditView.vue';
import HomePageView from '../views/HomePageView.vue';
import RelatorioLivrosPorAutorView from '../views/RelatorioLivrosPorAutorView.vue';

const routes = [
  {
    path: '/autores',
    name: 'Autores',
    component: AutoresView,
  },
  {
    path: '/autores/create',
    name: 'AutorCreate',
    component: AutorCreateView,
  },
  {
    path: '/autores/edit/:id',
    name: 'AutorEdit',
    component: AutorEditView,
    props: true,
  },

  {
    path: '/assuntos',
    name: 'Assuntos',
    component: AssuntosView,
  },
  {
    path: '/assuntos/create',
    name: 'AssuntoCreate',
    component: AssuntoCreateView,
  },
  {
    path: '/assuntos/edit/:id',
    name: 'AssuntoEdit',
    component: AssuntoEditView,
    props: true,
  },

  {
    path: '/livros',
    name: 'Livros',
    component: LivrosView,
  },
  {
    path: '/livros/create',
    name: 'LivroCreate',
    component: LivroCreateView,
  },
  {
    path: '/livros/edit/:id',
    name: 'LivroEdit',
    component: LivroEditView,
    props: true,
  },

  {
    path: '/relatorios/livros/autor/pdf',
    name: 'LivrosPorAutor',
    component: RelatorioLivrosPorAutorView,
    props: true,
  },


  { path: '/', component: HomePageView },

];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;