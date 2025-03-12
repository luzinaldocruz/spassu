import apiClient from "../apiClient";

class AutorResource {

    constructor() {
        this.endpoint = '/api/autores'
    }
    
    async getAll(page = 1, perPage = 10, filter = {}, sortBy = 'nome', sortDir = 'asc' ) {
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

    async create(autor) {
        const response = await apiClient.post(this.endpoint, autor)
        
        return response.data;
        
    }

    async update(id, autor) {
        const response = await apiClient.put(`${this.endpoint}/${id}`, autor)
        
        return response.data;
        
    }

    async delete(id) {
        const response = await apiClient.delete(`${this.endpoint}/${id}`)

        return response.data;
        
    }

    as

}

export default new AutorResource;