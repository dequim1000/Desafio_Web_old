<?php

include 'conexao.php';

class Client{

    public $id;
    private $email;
    private $accessToken;
    private $passwordClient;
    private $Document;
    private $NameClient;
    private $phone;

    public function Client($iden,$pass){
        $this->montaClient($iden,$pass);
    
    }
    private function montaClient($iden,$pass){
        $conexao = new Conexao();

        $consulta=$conexao->conecta()->query("SELECT * FROM Client WHERE Email='$iden'");
       
        foreach($consulta as $us){
        $this->id=$us["Id"];
        $this->email=$us["Email"];
        $this->passwordClient=$us["Password"];
        $this->accessToken=$us["accesstoken"];
        $this->Document=$us["Document"];
        $this->NameClient=$us["NameClient"];
        $this->phone=$us["phone"];
        }

    }
    public function getId(){
        return $this->id;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getPasswordClient(){
        return $this->passwordClient;
    }

    public function getAccessToken(){
        return $this->accessToken;
    }

    public function getDocument(){
        return $this->Document;
    }

    public function getNameClient(){
        return $this->NameClient;
    }
    
    public function getPhone(){
        return $this->phone;
    }
}


