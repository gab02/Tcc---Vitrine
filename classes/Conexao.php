<?php

/*constantes de conexão
define('DB_HOST', "127.0.0.1");
define('DB_USER', "root");
define('DB_PASSWORD', "");
define('DB_NAME', "syslogin");
define('DB_DRIVER', "mysql");
*/


define('DB_HOST'        , "172.16.48.10");
define('DB_USER'        , "vitrine");
define('DB_PASSWORD'    , "v1tr1n3");
define('DB_NAME'        , "VITRINE_201901");
define('DB_DRIVER'      , "sqlsrv");  


/*
define('DB_HOST'        , "IGOR-PC\SQLEXPRESS");
define('DB_USER'        , "");
define('DB_PASSWORD'    , "");
define('DB_NAME'        , "VITRINE_201901");
define('DB_DRIVER'      , "sqlsrv");
*/

/*

define('DB_HOST'        , "localhost");
define('DB_USER'        , "");
define('DB_PASSWORD'    , "");
define('DB_NAME'        , "VITRINE_201901");
define('DB_DRIVER'      , "sqlsrv");
*/

/**
 * Description of Conexao:
 * Classe dedicada a Instanciar PDO, ou seja, Conexão com o banco de dados
 * 
 * @author IgorShimun
 */
class Conexao {

    #Variável stática para ser chamada sem nescessidade de instanciar a classe
    private static $connection;

    /*
     * Função para iniciar conexãon instnanciando PDO e retornando o mesmo
     * @return PDO
     * @throw Exception
     */
    public static function getConnection() {
    #Funcão stática para ser chamada sem nescessidade de instanciar a classe
        $pdoConfig  = DB_DRIVER . ":". "Server=" . DB_HOST . ";";
       $pdoConfig .= "Database=".DB_NAME.";";

        try {
            if (!isset($connection)) {
                $connection = new \PDO($pdoConfig, DB_USER, DB_PASSWORD);
                $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
            return $connection;
        } catch (PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", PDO::getAvailableDrivers());
            $mensagem .= "\nErro: " . $e->getMessage();
            throw new Exception($mensagem);
        }
    }

}
