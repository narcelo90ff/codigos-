<?php

require_once __DIR__ . "/../Model/Usuario.php";

class HomeController {

    public static function index() {
        if (isset($_SESSION['id_usuario'])) {
            header("Location: ?p=dashboard");
            exit;
        }
        header("Location: ?p=login");
        exit;
    }

    public static function login() {
        if (isset($_SESSION['id_usuario'])) {
            header("Location: ?p=dashboard");
            exit;
        }
        require __DIR__ . "/../View/login.php";
    }

    /*
     * Valida as credenciais do formulário de login.
     * password_verify compara a senha digitada com o hash salvo no banco,
     * sem precisar descriptografar — isso é o que torna o bcrypt seguro.
     */
    public static function autenticar() {
        $usuario = trim($_POST['usuario'] ?? '');
        $senha   = $_POST['senha'] ?? '';

        $user = Usuario::buscarPorUsuario($usuario);

        if ($user && password_verify($senha, $user->senha)) {
            $_SESSION['id_usuario'] = $user->id;
            $_SESSION['nome']       = $user->nome;
            header("Location: ?p=dashboard");
        } else {
            header("Location: ?p=login");
        }
        exit;
    }

    // session_destroy apaga todos os dados da sessão, efetivamente deslogando o usuário
    public static function logout() {
        session_destroy();
        header("Location: ?p=login");
        exit;
    }
}
