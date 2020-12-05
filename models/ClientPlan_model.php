<?php
require_once 'Client_model.php';
require_once 'Conexao.php';

class ClientPlan{

    private $clientId;
    private $planId;
    private $smsCredits;



    public function fabricaClientPlan($clientId,$planId,$smsCredits){
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->smsCredits=$smsCredits;
    }


    public function getClientId(){
        return $this->clientId;

    }
    public function getPlanId(){
        return $this->planId;
    }
    public function getSMSCredits(){
        return $this->smsCredits;
}




public function trasDoBanco(){

    try{

    $conexa= new Conexao();
    $consulta = $conexao->conecta()->query();
    $retornaLista=array();
    foreach($consulta as $p){
       
        $pla = new PlanX();
        $cli = new Client();
        $cli->fabricaClient($p['Id'],$p['Email'],$p['Password'],$p['acesstoken'],$p['Document'],$p['Name'],$p['phone']);

        $pla->fabricaPlanX($p['ID'],$p['Name'],$p['RequestsQuantity'],$p['Price']);

        $clientPlan = new ClientPlan();
        $clientPlan->fabricaClientPlan($cli,$pla,$p['SMSCredits']);

        array_push($retornaLista,$clientPlan);

    }
    
    return $retornaLista;
    
    
    }catch(Exception $e){

        return $e;

    }


}

}