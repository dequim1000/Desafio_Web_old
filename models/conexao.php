<?php

class Conexao{

    private $user;
    private $pass;

    public function setUser($user){
        $this->$user= $user;
    }
    public function setPass($pass){
        $this->$pass =$pass;
    }
    public function getUser(){
        return $this->$user;
    }

    public function getPass(){
        return $this->$pass;
    }
    public function conecta(){
        
        $conexao = new PDO("mysql:host=localhost;dbname=EXPRESSOAPI;charset=utf8",'root','');
        echo 'Conexao realizada Com sucesso!!!';
        return $conexao;

    }


    
}


