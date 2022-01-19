<?php

class Conexao{
    private $host = 'localhost'; 
    private $user = 'root';
    private $senha = '';
    private $db = 'php_com_pdo';

    public function conectar(){
        try{

            $conexao = new PDO(
                "mysql:host=$this->host;dbname=$this->db",
                "$this->user",
                "$this->senha"
            );

            return $conexao;


        } catch( PDOException $e){
            echo '<p>'.$e->getMessege().'</p>';
        }
    }   
}


?>