<template>
  <nav aria-label="Paginação" v-if="links && meta">
    <ul class="pagination">

      <li class="page-item" :class="{ disabled: !links.prev }">
        <a
          class="page-link"
          href="#"
          @click.prevent="changePage(meta.current_page - 1)"
          aria-label="Anterior"
        >
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>

      <li
        v-for="link in meta.links"
        :key="link.label"
        class="page-item"
        :class="{ active: link.active, disabled: !link.url }"
      >
        <a
          class="page-link"
          href="#"
          @click.prevent="changePage(extractPageNumber(link.url))"
          v-html="link.label"
        ></a>
      </li>

      <li class="page-item" :class="{ disabled: !links.next }">
        <a
          class="page-link"
          href="#"
          @click.prevent="changePage(meta.current_page + 1)"
          aria-label="Próximo"
        >
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>
    </ul>
  </nav>
</template>

<script setup>
import { defineProps, defineEmits } from 'vue';

const props = defineProps({
  links: {
    type: Object,
    required: true,
  },
  meta: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(['page-changed']);

const changePage = (page) => {
  if (page === props.meta.current_page || page < 1 || page > props.meta.last_page) {
    return; 
  }
  emit('page-changed', page); 
};


const extractPageNumber = (url) => {
  if (!url) return null;
  const match = url.match(/page=(\d+)/);
  return match ? parseInt(match[1], 10) : null;
};
</script>

<style scoped>
.pagination {
  display: flex;
  justify-content: center;
  margin-top: 20px;
}

.page-item {
  margin: 0 5px;
}

.page-item.disabled .page-link {
  pointer-events: none;
  opacity: 0.6;
}

.page-item.active .page-link {
  background-color: #007bff;
  border-color: #007bff;
  color: white;
}

.page-link {
  cursor: pointer;
}
</style>