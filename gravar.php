<?php

require_once 'Database.php';
require_once 'Livro.php';

$id = isset($_GET['id']) && $_GET['id'] !== '' ? (int) $_GET['id'] : null;
$titulo = trim($_GET['titulo'] ?? '');
$autor = trim($_GET['autor'] ?? '');
$paginas = isset($_GET['paginas']) && $_GET['paginas'] !== '' ? (int) $_GET['paginas'] : null;
$genero = trim($_GET['genero'] ?? '');

$generosPermitidos = ['Romance', 'Ficção Científica', 'Biografia', 'Técnico'];

if (
    $titulo !== '' &&
    mb_strlen($titulo) <= 150 &&
    $autor !== '' &&
    mb_strlen($autor) <= 100 &&
    in_array($genero, $generosPermitidos, true)
) {
    $livro = new Livro();

    if ($id !== null) {
        $livro->atualizar($titulo, $autor, $paginas, $genero, $id);
    } else {
        $livro->inserir($titulo, $autor, $paginas, $genero);
    }
}

header('Location: index.php');
exit;
