<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{

    use HasFactory;

    protected $table = 'livro';
    protected $primaryKey = 'Codl';
    protected $fillable = ['Codl', 'Titulo', 'Editora', 'Edicao', 'AnoPublicacao'];

    public function preco()
    {
        return $this->hasOne(LivroPreco::class, 'Livro_Codl', 'Codl')->whereNull('deleted_at');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class, 'livro_autor', 'Livro_Codl', 'Autor_CodAu', 'Codl', 'CodAu')->orderBy('nome', 'asc');
    }

    public function assuntos()
    {
        return $this->belongsToMany(Assunto::class, 'livro_assunto', 'Livro_Codl', 'Assunto_CodAs', 'Codl', 'CodAs')->orderBy('descricao', 'asc');
    }
}
