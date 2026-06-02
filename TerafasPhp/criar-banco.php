<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Banco — TerafasPhp</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f0f2f5; display: flex; justify-content: center; padding: 3rem 1rem; }
        main { background: #fff; border-radius: 10px; box-shadow: 0 4px 20px rgba(0,0,0,.1); padding: 2rem; width: 100%; max-width: 500px; }
        h1 { font-size: 1.4rem; color: #2c3e50; margin-bottom: 1.5rem; }
        p { padding: .7rem 1rem; border-radius: 6px; margin-bottom: .75rem; font-size: .95rem; }
        p.ok  { background: #eafaf1; color: #27ae60; border-left: 4px solid #27ae60; }
        p.erro { background: #fdecea; color: #c0392b; border-left: 4px solid #c0392b; }
        a { display: inline-block; margin-top: 1rem; padding: .6rem 1.2rem; background: #3498db; color: #fff; border-radius: 5px; text-decoration: none; font-size: .9rem; }
        a:hover { background: #2980b9; }
        form button { padding: .7rem 1.5rem; background: #27ae60; color: #fff; border: none; border-radius: 5px; font-size: 1rem; cursor: pointer; }
        form button:hover { background: #219150; }
    </style>
</head>
<body>
<main>
    <h1>Instalação do Banco de Dados</h1>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'):

        // Conecta sem selecionar banco para poder criá-lo
        $conn = new mysqli("localhost", "root", "");

        if ($conn->connect_error) {
            echo "<p class='erro'>Erro de conexão: " . $conn->connect_error . "</p>";
        } else {

            $comandos = [
                "CREATE DATABASE IF NOT EXISTS aulaphp CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci",

                "USE aulaphp",

                "CREATE TABLE IF NOT EXISTS usuarios (
                    id      INT AUTO_INCREMENT PRIMARY KEY,
                    nome    VARCHAR(100) NOT NULL,
                    usuario VARCHAR(50)  NOT NULL UNIQUE,
                    senha   VARCHAR(255) NOT NULL
                )",

                "CREATE TABLE IF NOT EXISTS tarefas (
                    id         INT AUTO_INCREMENT PRIMARY KEY,
                    idUsuario  INT  NOT NULL,
                    texto      TEXT NOT NULL,
                    FOREIGN KEY (idUsuario) REFERENCES usuarios(id) ON DELETE CASCADE
                )",

                // Usuários de teste — senha criptografada com bcrypt
                "INSERT IGNORE INTO usuarios (nome, usuario, senha) VALUES
                    ('Administrador', 'admin', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
                    ('José Silva',    'jose',  '\$2y\$10\$mTR7TuWQ6HhzE0cWhVX1jeerLW1kDWlqtKHDCHy7EKlTXv6k5baI6'),
                    ('Maria Souza',   'maria', '\$2y\$10\$mTR7TuWQ6HhzE0cWhVX1jeerLW1kDWlqtKHDCHy7EKlTXv6k5baI6')",

                "INSERT IGNORE INTO tarefas (idUsuario, texto) VALUES
                    (2, 'Comprar mantimentos no mercado'),
                    (2, 'Pagar a conta de luz'),
                    (2, 'Estudar PHP e MVC'),
                    (3, 'Entregar relatório para o chefe'),
                    (3, 'Fazer academia às 18h'),
                    (3, 'Responder e-mails pendentes')",
            ];

            foreach ($comandos as $sql) {
                if (!$conn->query($sql)) {
                    echo "<p class='erro'>Erro: " . $conn->error . "</p>";
                }
            }

            $conn->close();
            header("Location: ?p=login");
            exit;
        }

    else: ?>

        <p style="color:#555; margin-bottom:1.5rem; font-size:.95rem;">
            Clique no botão abaixo para criar o banco de dados, as tabelas e os usuários de teste.
        </p>

        <table style="width:100%; font-size:.85rem; border-collapse:collapse; margin-bottom:1.5rem;">
            <tr><th style="text-align:left; padding:.4rem; color:#555;">Usuário</th><th style="text-align:left; padding:.4rem; color:#555;">Senha</th></tr>
            <tr><td style="padding:.4rem;">admin</td><td style="padding:.4rem;">password</td></tr>
            <tr><td style="padding:.4rem;">jose</td><td style="padding:.4rem;">123</td></tr>
            <tr><td style="padding:.4rem;">maria</td><td style="padding:.4rem;">123</td></tr>
        </table>

        <form method="POST">
            <button type="submit">Criar banco de dados</button>
        </form>

    <?php endif; ?>
</main>
</body>
</html>
