<?php
require_once 'Conexao.php';
require_once 'Client_model.php';

class ClientApi{


    private $clientId;
    private $apiId;
    private $username;
    private $password;



    public function fabricaClientApi($clientId,$apiId,$username,$password){
        $this->clientId=$clientId;
        $this->apiId=$apiId;
        $this->username=$username;
        $this->password=$password;
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
    public function getPassword(){
        return $this->password;
    }



    public function trasDoBanco(){
        
        try{
            $listaRetorno=array();
            $conexao = new Conexao();
            $consulta=$conexao->conecta()->query();
            
            foreach($consulta as $p){
               
                //Monta o Client
                $cli = new Client();
                $cli->fabricaClient($p['Id'],$p['Email'],$p['Password'],$p['acesstoken'],$p['Document'],$p['Name'],$p['phone']);
               //Monta a 
                $cliApi = new ClientApi();
                $cliApi->fabricaClientApi($cli,$p['ApiId'],$p['Username'],$p['Password']);
                array_push($listaRetorno,$cliApi);
            }
            return $listaRetorno;
        }catch(Exception $e){
            return $e;
        }

    }


    public function incluirNoBanco(){

        try{
            $conexao= new Conexao();
            $conexao->conecta()->query();
            return 'ok';
        }catch(Exception $e){
            return $e;
        }
    }
}