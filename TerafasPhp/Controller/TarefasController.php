<?php

require_once __DIR__ . "/../Model/Tarefa.php";

class TarefasController {

    public static function index() {
        $idUsuario = $_SESSION['id_usuario'];
        $tarefas   = Tarefa::listarPorUsuario($idUsuario);
        $total     = count($tarefas);
        require __DIR__ . "/../View/dashboard.php";
    }

    /*
     * Trata tanto o GET (exibir formulário) quanto o POST (salvar tarefa).
     * Usando uma única rota "add" para as duas ações, o formulário sempre
     * volta para a mesma URL em caso de erro.
     */
    public static function addTarefa() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $texto = trim($_POST['texto'] ?? '');

            if ($texto === '') {
                header("Location: ?p=add");
                exit;
            }

            Tarefa::criar($_SESSION['id_usuario'], $texto);
            header("Location: ?p=dashboard");
            exit;
        }

        require __DIR__ . "/../View/form_tarefa.php";
    }

    /*
     * Verifica se a tarefa pertence ao usuário logado antes de exibir o formulário.
     * Isso impede que um usuário edite tarefas de outro usuário alterando o id na URL.
     */
    public static function editarTarefa($id) {
        $tarefa = Tarefa::buscarPorId($id);

        if (!$tarefa || $tarefa->idUsuario != $_SESSION['id_usuario']) {
            header("Location: ?p=dashboard");
            exit;
        }

        require __DIR__ . "/../View/form_tarefa.php";
    }

    public static function atualizarTarefa() {
        $id    = (int) ($_POST['id'] ?? 0);
        $texto = trim($_POST['texto'] ?? '');

        if ($texto === '') {
            header("Location: ?p=editar&id=$id");
            exit;
        }

        Tarefa::atualizar($id, $_SESSION['id_usuario'], $texto);
        header("Location: ?p=dashboard");
        exit;
    }

    public static function apagarTarefa($id) {
        Tarefa::excluir($id, $_SESSION['id_usuario']);
        header("Location: ?p=dashboard");
        exit;
    }
}
