<?php
$editando = isset($tarefa);
$title    = $editando ? 'Editar Tarefa' : 'Nova Tarefa';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?> — TerafasPhp</title>
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

<?php require __DIR__ . "/navbar.php"; ?>

<main>

    <h1><?= $title ?></h1>

    <section>
        <form method="POST" action="?p=<?= $editando ? 'atualizar' : 'add' ?>">

            <?php if ($editando): ?>
                <input type="hidden" name="id" value="<?= $tarefa->id ?>">
            <?php endif; ?>

            <div>
                <label for="texto">Descrição da tarefa</label>
                <textarea id="texto" name="texto" rows="4" required><?= $editando ? htmlspecialchars($tarefa->texto) : '' ?></textarea>
            </div>

            <footer>
                <button type="submit"><?= $editando ? 'Salvar alterações' : 'Criar tarefa' ?></button>
                <a href="?p=dashboard">Cancelar</a>
            </footer>

        </form>
    </section>

</main>
</body>
</html>
