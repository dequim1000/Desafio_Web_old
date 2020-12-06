<?php

require_once 'conexao.php';
require_once 'Planx_model.php';
require_once 'ClientPlan_model.php';
require_once 'Client_model.php';
class Apirequest{
    private $id;
    private $clientId;
    private $planId;
    private $dtRequest;
    private $url;
    private $body;
    private $responseStatus;
    private $responseBody;
    private $postActions;

    public function fabricaApirequest($id,$clientId,$planId,$dtRequest,$url,$body,$responseStatus,$responseBody,$postActions){
        $this->id=$id;
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->dtRequest=$dtRequest;
        $this->url=$url;
        $this->body=$body;
        $this->responseStatus=$responseStatus;
        $this->responseBody=$responseBody;
        $this->postActions=$postActions;
    }

    public function getId(){
        return $this->id;
    }

    public function getClientId(){
        return $this->clientId;

    }
    public function getPlanId(){
        return $this->planId;
    }

    public function getDtrequest(){
        return $this->dtRequest;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getBody(){
        return $this->body;
    }
    public function getStatus(){
        return $this->responseStatus;
    }
    public function getResponsebody(){
        return $this->responseBody;
    }
    public function getPost(){
        return $this->postActions;
    }

    public function trasDoBanco(){
    $retornoDoBanco=array();

    $conexao= new Conexao();

    $consulta= $conexao->conecta()-query('');

    $ret=array();
        foreach($consulta as $con){
            
            $cli= new Client();

            $planx= new PlanX();
            $cliApi = new ClientApi();
            $cliPlan= new ClientPlan();


            
        }
    
    }
}
?>