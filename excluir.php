<?php

require_once 'Database.php';
require_once 'Livro.php';

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $id = (int) $_GET['id'];
    $livro = new Livro();
    $livro->excluir($id);
}

header('Location: index.php');
exit;
