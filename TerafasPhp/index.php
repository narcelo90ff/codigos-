<?php

session_start();

require "Controller/HomeController.php";
require "Controller/TarefasController.php";

$pagina = $_GET['p'] ?? 'banco';

// Verifica se o usuário está logado antes de acessar qualquer página protegida
$publicas = ['login', 'autenticar', 'banco'];

if (!isset($_SESSION['id_usuario']) && !in_array($pagina, $publicas)) {
    header("Location: ?p=login");
    exit;
}

// Direciona para o método correto do controller com base na rota acessada
match($pagina) {
    'login'      => HomeController::login(),
    'autenticar' => HomeController::autenticar(),
    'logout'     => HomeController::logout(),

    'banco'      => require("criar-banco.php"),

    'dashboard'  => TarefasController::index(),

    'add'        => TarefasController::addTarefa(),
    'editar'     => TarefasController::editarTarefa($_GET['id'] ?? 0),
    'atualizar'  => TarefasController::atualizarTarefa(),
    'apagar'     => TarefasController::apagarTarefa($_GET['id'] ?? 0),

    default      => HomeController::index(),
};
