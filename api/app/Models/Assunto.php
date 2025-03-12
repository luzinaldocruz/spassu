<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assunto extends Model
{
    protected $table = 'assunto';
    protected $primaryKey = 'CodAs';
    protected $fillable = ['CodAs', 'descricao'];
}
