<?php

class Conexao {
    public static $instance;
    private function __construct() {}

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new PDO('mysql:host=;dbname=', '', '', array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
        }  
        return self::$instance;
    }
}

class ConsultaBase{

    private function __construct() {}

    public static function selectQuery($data){
        return self::runSelectQuery($data);
    }

    public static function insertQuery($data){
        return self::runInsertQuery($data);
    }

    private static function runSelectQuery($sql){
        try {  
                $sql = utf8_encode($sql);
                $result = Conexao::getInstance()->query($sql);
                $final_result = $result->fetchAll(PDO::FETCH_ASSOC);
                return $final_result;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }

    //public static function selectQueryLogin($paramLogin, $paramKey){
    public static function selectQueryLogin($paramLogin){
        try {  

                /*$stmt = Conexao::getInstance()->prepare('SELECT ID, ID_CLI, CLI_NOME, CLI_LOGIN, CLI_PASSWD, LOJA
                                                         FROM clientes_web
                                                         WHERE CLI_LOGIN = :login
                                                         AND CLI_PASSWD = :senha;');*/
                $stmt = Conexao::getInstance()->prepare('SELECT ID, ID_CLI, CLI_NOME, CLI_LOGIN, CLI_PASSWD, LOJA
                                                         FROM clientes_web
                                                         WHERE CLI_LOGIN = :login;');
                $stmt->bindParam(':login', $paramLogin);
                //$stmt->bindParam(':senha', $paramKey);
                $stmt->execute();

                //$sql = utf8_encode($sql);
                //$result = Conexao::getInstance()->query($sql); 
                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $final_result;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }

    public static function selectQueryLoginAdmin($paramLogin, $paramKey)
    {
        try {  
                $stmt = Conexao::getInstance()->prepare('SELECT *
                                                         FROM acesso_admin
                                                         WHERE LOGIN = :login
                                                         AND SENHA = :senha;');
                $stmt->bindParam(':login', $paramLogin);
                $stmt->bindParam(':senha', $paramKey);
                $stmt->execute();

                //$sql = utf8_encode($sql);
                //$result = Conexao::getInstance()->query($sql); 
                $final_result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $final_result;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    }

    private static function runInsertQuery($sql){
        try {
                $sql = utf8_encode($sql);
                $result = Conexao::getInstance()->prepare($sql); 
                $result->execute();
                return $result->rowCount();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
    } 
}