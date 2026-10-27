<?php

require_once 'Database.php';
require_once 'Livro.php';

$livroModel = new Livro();
$livroEdicao = null;

if (isset($_GET['id']) && $_GET['id'] !== '') {
    $livroEdicao = $livroModel->listarPorId((int) $_GET['id']);
}

$livros = $livroModel->listar();
$generosPermitidos = ['Romance', 'Ficção Científica', 'Biografia', 'Técnico'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Comunitária</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 30px auto;
            padding: 0 15px;
            color: #333;
        }
        h1, h2 {
            color: #2c3e50;
        }
        form {
            background: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 6px;
            margin-bottom: 30px;
        }
        .campo {
            margin-bottom: 12px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 4px;
        }
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button, .btn-cancelar {
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }
        button {
            background-color: #2980b9;
            color: #fff;
        }
        .btn-cancelar {
            background-color: #7f8c8d;
            color: #fff;
            margin-left: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .acoes a {
            margin-right: 10px;
            text-decoration: none;
            color: #2980b9;
        }
        .acoes a.excluir {
            color: #c0392b;
        }
    </style>
</head>
<body>

    <h1>Biblioteca Comunitária</h1>

    <h2><?= $livroEdicao ? 'Editar Livro' : 'Cadastrar Livro' ?></h2>

    <form action="gravar.php" method="get">
        <input type="hidden" name="id" value="<?= htmlspecialchars((string) ($livroEdicao['id'] ?? '')) ?>">

        <div class="campo">
            <label for="titulo">Título *</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                maxlength="150"
                required
                value="<?= htmlspecialchars($livroEdicao['titulo'] ?? '') ?>"
            >
        </div>

        <div class="campo">
            <label for="autor">Autor *</label>
            <input
                type="text"
                id="autor"
                name="autor"
                maxlength="100"
                required
                value="<?= htmlspecialchars($livroEdicao['autor'] ?? '') ?>"
            >
        </div>

        <div class="campo">
            <label for="paginas">Páginas (opcional)</label>
            <input
                type="number"
                id="paginas"
                name="paginas"
                min="1"
                value="<?= htmlspecialchars((string) ($livroEdicao['paginas'] ?? '')) ?>"
            >
        </div>

        <div class="campo">
            <label for="genero">Gênero *</label>
            <select id="genero" name="genero" required>
                <option value="">Selecione...</option>
                <?php foreach ($generosPermitidos as $genero): ?>
                    <option
                        value="<?= htmlspecialchars($genero) ?>"
                        <?= (($livroEdicao['genero'] ?? '') === $genero) ? 'selected' : '' ?>
                    >
                        <?= htmlspecialchars($genero) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Salvar</button>
        <?php if ($livroEdicao): ?>
            <a href="index.php" class="btn-cancelar">Cancelar</a>
        <?php endif; ?>
    </form>

    <h2>Acervo de Livros</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Páginas</th>
                <th>Gênero</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($livros)): ?>
                <tr>
                    <td colspan="6">Nenhum livro cadastrado.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($livros as $l): ?>
                    <tr>
                        <td><?= htmlspecialchars((string) $l['id']) ?></td>
                        <td><?= htmlspecialchars($l['titulo']) ?></td>
                        <td><?= htmlspecialchars($l['autor']) ?></td>
                        <td><?= $l['paginas'] !== null ? htmlspecialchars((string) $l['paginas']) : '-' ?></td>
                        <td><?= htmlspecialchars($l['genero']) ?></td>
                        <td class="acoes">
                            <a href="index.php?id=<?= urlencode((string) $l['id']) ?>">Editar</a>
                            <a href="excluir.php?id=<?= urlencode((string) $l['id']) ?>" class="excluir" onclick="return confirm('Deseja realmente excluir este livro?');">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
