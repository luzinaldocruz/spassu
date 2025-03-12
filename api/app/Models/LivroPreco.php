<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LivroPreco extends Model
{
    use SoftDeletes;

    protected $table = 'livro_preco';
    public $incrementing = false;
    protected $primaryKey = null;
    protected $fillable = ['Livro_Codl', 'Preco', 'Data'];

    protected $dates = ['deleted_at'];
}
