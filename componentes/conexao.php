<?php

defined('BASEPATH') or exit('Acesso não permitido');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Config
{
    private static $local = "localhost";
    private static $banco = "controle_de_estoque";
    private static $usuario = "root";
    private static $senha = "";

    public static function connect()
    {
        $dsn = 'mysql:host=' . self::$local . ';dbname=' . self::$banco . ';charset=utf8mb4';

        try {
            $con = new PDO($dsn, self::$usuario, self::$senha);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $con;
        } catch (PDOException $e) {
            self::handleError('Erro no banco de dados: ' . $e->getMessage());
        } catch (Exception $e) {
            self::handleError('Erro na página: ' . $e->getMessage());
        }
    }

    private static function handleError($msg)
    {
        $paginaAtual = self::getCurrentPage();

        echo "<script>
            alert('Erro de conexão');
        </script>";

        exit();
    }

    public static function getCurrentPage()
    {
        $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";

        $raizSite = $protocolo . $_SERVER['HTTP_HOST'];
        $paginaAtual = $raizSite . $_SERVER['REQUEST_URI'];

        return $paginaAtual;
    }
}
