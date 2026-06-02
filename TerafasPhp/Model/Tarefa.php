<?php

require_once __DIR__ . "/../Config/Banco.php";

class Tarefa {

    // Percorre todos os resultados e monta um array de objetos para usar na view
    public static function listarPorUsuario($idUsuario) {
        $sql    = "SELECT * FROM tarefas WHERE idUsuario = $idUsuario ORDER BY id DESC";
        $result = Banco::getConn()->query($sql);

        $tarefas = [];
        while ($t = $result->fetch_object()) {
            $tarefas[] = $t;
        }

        return $tarefas;
    }

    public static function buscarPorId($id) {
        $sql    = "SELECT * FROM tarefas WHERE id = '$id' LIMIT 1";
        $result = Banco::getConn()->query($sql);
        return $result->fetch_object();
    }

    public static function criar($idUsuario, $texto) {
        $sql = "INSERT INTO tarefas (id, idUsuario, texto) VALUES (NULL, '$idUsuario', '$texto')";
        return Banco::getConn()->query($sql);
    }

    public static function atualizar($id, $idUsuario, $texto) {
        $sql = "UPDATE tarefas SET texto = '$texto' WHERE id = '$id' AND idUsuario = '$idUsuario'";
        return Banco::getConn()->query($sql);
    }

    public static function excluir($id, $idUsuario) {
        $sql = "DELETE FROM tarefas WHERE id = '$id' AND idUsuario = '$idUsuario'";
        return Banco::getConn()->query($sql);
    }
}
