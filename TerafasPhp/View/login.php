<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — TerafasPhp</title>
    <link rel="stylesheet" href="public/css/login.css">
</head>
<body>

<main>
    <h1>TerafasPhp</h1>
    <p>Faça login para acessar suas tarefas</p>

    <form method="POST" action="?p=autenticar">
        <div>
            <label for="usuario">Usuário</label>
            <input type="text" id="usuario" name="usuario" autofocus required>
        </div>
        <div>
            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit">Entrar</button>
    </form>

    <form action="?p=banco">
        <button type="submit">Criar banco de dados</button>
    </form>
</main>

</body>
</html>
