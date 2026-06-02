<?php

require_once __DIR__ . "/../Config/Banco.php";

class Usuario {

    public static function buscarPorUsuario($usuario) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' LIMIT 1";
        $result  = Banco::getConn()->query($sql);
        return $result->fetch_object();
    }

    public static function buscarPorId($id) {
        $sql    = "SELECT id, nome, usuario FROM usuarios WHERE id = '$id' LIMIT 1";
        $result = Banco::getConn()->query($sql);
        return $result->fetch_object();
    }
}
