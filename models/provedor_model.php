<?php

include 'conexao.php';

class Provedor{

    public  $clientId;
    private $apiId;
    private $username;
    private $password;
    private $name;

    public function Provedor($iden,$pass){
        $this->montaProvedor($iden,$pass);
    
    }

    private function montaProvedor($iden,$pass){
        $conexao = new Conexao();

        $consulta=$conexao->conecta()->query("SELECT * FROM ClientApi JOIN Api WHERE Id = ApiId and Username='$iden'");
        
        foreach($consulta as $us){
        $this->clientId=$us["ClientId"];
        $this->apiId=$us["ApiId"];
        $this->username=$us["Username"];
        $this->password=$us["Password"];
        $this->name=$us["Name"];
        }

    }

    public function getClientId(){
        return $this->clientId;
    }

    public function getApiId(){
        return $this->apiId;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPass(){
        return $this->password;
    }

    public function getName(){
        return $this->name;
    }

}
