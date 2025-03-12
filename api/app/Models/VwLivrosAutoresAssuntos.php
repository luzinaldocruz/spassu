<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VwLivrosAutoresAssuntos extends Model
{
    protected $table = 'vw_livros_autores_assuntos';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'CodAu',
        'Autor',
        'Codl',
        'Titulo',
        'Edicao',
        'AnoPublicacao',
        'Editora',
        'CodAs',
        'Assunto'
    ];
}
