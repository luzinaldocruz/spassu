import apiClient from '../apiClient';

class LivroResource {
  constructor() {
    this.endpoint = '/api/livros';
  }

  async getAll(page = 1, perPage = 10, filters = {}, sortBy = 'Titulo', sortDir = 'asc') {
    const response = await apiClient.get(this.endpoint, {
      params: {
        page,
        per_page: perPage,
        ...filters,
        sort_by: sortBy,
        sort_dir: sortDir,
      },
    });
    return response.data;
  }

  async get(id) {
    const response = await apiClient.get(`${this.endpoint}/${id}`);
    return response.data;
  }

async create(livro) {
    const response = await apiClient.post(this.endpoint, livro);
    return response.data;
}

  async update(id, livro) {
    const response = await apiClient.put(`${this.endpoint}/${id}`, livro);
    return response.data;
  }

  async delete(id) {
    const response = await apiClient.delete(`${this.endpoint}/${id}`);
    return response.data;
  }

  async patch(id, partialLivro) {
    const response = await apiClient.patch(`${this.endpoint}/${id}`, partialLivro);
    return response.data;
  }
}

export default new LivroResource();