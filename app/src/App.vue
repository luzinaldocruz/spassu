<script setup>
</script>

<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container">
        <a class="navbar-brand" href="#">Spassu</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Início</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/autores">Autores</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/assuntos">Assuntos</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/livros">Livros</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <div class="container">
      <router-view></router-view>
    </div>
  </div>
</template>

<style scoped>
.navbar-nav .nav-link {
  text-decoration: none;
  color: #333;
}

.navbar-nav .nav-link:hover {
  color: #007bff;
}
</style>