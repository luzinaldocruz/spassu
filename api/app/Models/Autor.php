<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    protected $table = 'autor';
    protected $primaryKey = 'CodAu';
    protected $fillable = ['CodAu', 'nome'];

    public function scopeOrdenado($query)
    {
        return $query->orderBy('nome', 'asc');
    }
}
