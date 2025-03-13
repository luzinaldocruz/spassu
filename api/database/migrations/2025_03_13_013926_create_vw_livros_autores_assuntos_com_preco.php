<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_livros_autores_assuntos AS
            SELECT 
                a.\"CodAu\",
                a.nome AS Autor,
                l.\"Codl\",
                l.\"Titulo\",
                l.\"Edicao\",
                l.\"AnoPublicacao\",
                l.\"Editora\",
                ass.\"CodAs\",
                ass.descricao AS Assunto,
                lp.\"Preco\"
            FROM livro l
            INNER JOIN livro_autor la ON la.\"Livro_Codl\" = l.\"Codl\"
            INNER JOIN autor a ON a.\"CodAu\" = la.\"Autor_CodAu\"
            INNER JOIN livro_assunto lass ON lass.\"Livro_Codl\" = l.\"Codl\"
            INNER JOIN assunto ass ON ass.\"CodAs\" = lass.\"Assunto_CodAs\"
            INNER JOIN livro_preco lp ON lp.\"Livro_Codl\" = l.\"Codl\" AND lp.deleted_at IS NULL
            ORDER BY a.nome, l.\"Titulo\", ass.descricao;
        ");
    }

    public function down(): void
    {
        DB::statement("
            CREATE OR REPLACE VIEW vw_livros_autores_assuntos AS
            SELECT 
                a.\"CodAu\",
                a.nome AS Autor,
                l.\"Codl\",
                l.\"Titulo\",
                l.\"Edicao\",
                l.\"AnoPublicacao\",
                l.\"Editora\",
                ass.\"CodAs\",
                ass.descricao AS Assunto
            FROM livro l
            INNER JOIN livro_autor la ON la.\"Livro_Codl\" = l.\"Codl\"
            INNER JOIN autor a ON a.\"CodAu\" = la.\"Autor_CodAu\"
            INNER JOIN livro_assunto lass ON lass.\"Livro_Codl\" = l.\"Codl\"
            INNER JOIN assunto ass ON ass.\"CodAs\" = lass.\"Assunto_CodAs\"
            ORDER BY a.nome, l.\"Titulo\", ass.descricao;
        ");
    }
};
