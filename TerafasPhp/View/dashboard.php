<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — TerafasPhp</title>
    <link rel="stylesheet" href="public/css/main.css">
</head>
<body>

<?php require __DIR__ . "/navbar.php"; ?>

<main>

    <header>
        <h1>Minhas Tarefas</h1>
        <a href="?p=add">+ Nova Tarefa</a>
    </header>

    <aside>
        <strong><?= $total ?></strong>
        <small>Tarefas cadastradas</small>
    </aside>

    <section>
        <?php if (empty($tarefas)): ?>
            <p>Nenhuma tarefa cadastrada ainda. <a href="?p=add">Criar a primeira</a>.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tarefa</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $t): ?>
                    <tr>
                        <td><?= $t->id ?></td>
                        <td><?= htmlspecialchars($t->texto) ?></td>
                        <td>
                            <a href="?p=editar&id=<?= $t->id ?>">Editar</a>
                            <form method="POST" action="?p=apagar&id=<?= $t->id ?>"
                                  onsubmit="return confirm('Remover esta tarefa?')">
                                <button type="submit">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </section>

</main>
</body>
</html>
