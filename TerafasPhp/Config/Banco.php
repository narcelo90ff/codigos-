<?php

abstract class Banco {
    private static $conn;

    /*
     * Retorna sempre a mesma conexão com o banco durante a requisição.
     * Se ainda não existir, cria uma nova — esse padrão se chama Singleton.
     */
    public static function getConn(): mysqli {
        if (!isset(self::$conn)) {
            self::$conn = new mysqli("localhost", "root", "", "aulaphp");

            if (self::$conn->connect_error) {
                session_destroy();
                header("Location: ?p=banco");
                exit;
            }

            self::$conn->set_charset('utf8mb4');
        }

        return self::$conn;
    }
}
