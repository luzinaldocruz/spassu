import apiClient from "../apiClient";

class RelatorioResource {
    constructor() {
        this.endpoint = '/api/relatorios/livros/autor/pdf';
    }

    async getLivrosPorAutor(filters) {
        const response = await apiClient.get(this.endpoint, {
            params: {
                ...filters,
                no_pagination: true,
            },
            responseType: 'blob',
        });
        return response;
    }
}

export default new RelatorioResource();