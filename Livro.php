<?php

require_once 'Database.php';

class Livro
{
    public ?int $id = null;
    public string $titulo;
    public string $autor;
    public ?int $paginas = null;
    public string $genero;
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = Database::getConnection();
    }

    public function inserir(string $titulo, string $autor, ?int $paginas, string $genero): bool
    {
        $sql = "INSERT INTO livro (titulo, autor, paginas, genero) VALUES (:titulo, :autor, :paginas, :genero)";
        $smt = $this->conexao->prepare($sql);
        $smt->bindValue(':titulo', $titulo);
        $smt->bindValue(':autor', $autor);
        $smt->bindValue(':paginas', $paginas);
        $smt->bindValue(':genero', $genero);
        return $smt->execute();
    }

    public function atualizar(string $titulo, string $autor, ?int $paginas, string $genero, int $id): bool
    {
        $sql = "UPDATE livro SET titulo = :titulo, autor = :autor, paginas = :paginas, genero = :genero WHERE id = :id";
        $smt = $this->conexao->prepare($sql);
        $smt->bindValue(':titulo', $titulo);
        $smt->bindValue(':autor', $autor);
        $smt->bindValue(':paginas', $paginas);
        $smt->bindValue(':genero', $genero);
        $smt->bindValue(':id', $id);
        return $smt->execute();
    }

    public function listar(): array
    {
        $sql = "SELECT * FROM livro";
        $smt = $this->conexao->query($sql);
        return $smt->fetchAll();
    }

    public function listarPorId(int $id): array|false
    {
        $sql = "SELECT * FROM livro WHERE id = :id";
        $smt = $this->conexao->prepare($sql);
        $smt->bindValue(':id', $id);
        $smt->execute();
        return $smt->fetch();
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM livro WHERE id = :id";
        $smt = $this->conexao->prepare($sql);
        $smt->bindValue(':id', $id);
        return $smt->execute();
    }
}
