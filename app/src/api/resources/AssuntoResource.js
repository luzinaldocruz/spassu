import apiClient from "../apiClient";

class AssuntoResource {

    constructor() {
        this.endpoint = '/api/assuntos'
    }
    
    async getAll(page = 1, perPage = 10, filter = {}, sortBy = 'Descricao', sortDir = 'asc' ) {
        const response = await apiClient.get(this.endpoint, {
            params: {
                page,
                per_page : perPage,
                ...filter,
                sort_by: sortBy,
                sort_dir: sortDir
            }
        })
        return response.data;
    }

    async getAllNoPaginate() {
        const response = await apiClient.get(this.endpoint, {
            params: {
                no_pagination: true,
            }
        })
        return response.data;
    }

    async get(id) {
        const response = await apiClient.get(`${this.endpoint}/${id}`)

        return response.data;
        
    }

    async create(assuntos) {
        const response = await apiClient.post(this.endpoint, assuntos)
        
        return response.data;
        
    }

    async update(id, assuntos) {
        const response = await apiClient.put(`${this.endpoint}/${id}`, assuntos)
        
        return response.data;
        
    }

    async delete(id) {
        const response = await apiClient.delete(`${this.endpoint}/${id}`)

        return response.data;
        
    }

}

export default new AssuntoResource;