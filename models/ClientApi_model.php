<?php
require_once 'conexao.php';

class ClientApi{


    private $clientId;
    private $apiId;
    private $username;
    private $password;
    private $name;



    public function fabricaClientApi($clientId,$apiId,$username,$password,$name){
        $this->clientId=$clientId;
        $this->apiId=$apiId;
        $this->username=$username;
        $this->password=$password;
        $this->name=$name;
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
    public function getNome(){
        return $this->name;
    }



    public function trasDoBanco($clientId){
        
        try{
            $listaRetorno=array();
            $conexao = new Conexao();
            $consulta=$conexao->conecta()->query("
            SELECT CP.CLIENTID AS 'IDCLIENT'
            ,CP.APIID AS 'IDAPI'
            ,CP.USERNAME AS 'USER'
            ,CP.PASSWORD AS 'PASS'
            ,AP.NAME AS 'NAME'
            FROM ClientApi as CP 
            JOIN Api as AP
            ON CP.ApiId = AP.Id
            JOIN CLIENT AS C
            ON CP.ClientId = C.ID
            WHERE CP.CLIENTID = $clientId
            group by CP.APIID;
            ");
            
            foreach($consulta as $p){
                $cliApi = new ClientApi();
                $cliApi->fabricaClientApi($p['IDCLIENT'],$p['IDAPI'],$p['USER'],$p['PASS'],$p['NAME']);
                array_push($listaRetorno,$cliApi);
            }
            return $listaRetorno;
        }catch(Exception $e){
            return $e;
        }

    }


    public function incluirNoBanco(){
        $clientId = $this->clientId;
        $apiId = $this->apiId;
        $username = $this->username;
        $password = $this->password;
        try{
            $conexao= new Conexao();
            $conexao->conecta()->query("insert into ClientApi (ClientId, ApiId, Username, Password) values ($clientId, $apiId, '$username', '$password');");
            return 'ok';
        }catch(Exception $e){
            return $e;
        }
    }

    public function excluirNoBanco($clientId, $apiId){
        $conexao= new Conexao();
        $conexao->conecta()->query("delete from ClientApi where ClientId = $clientId and ApiId = $apiId;");
    }
}