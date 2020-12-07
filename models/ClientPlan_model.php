<?php
require_once 'Client_model.php';
require_once 'conexao.php';
require_once 'Planx_model.php';
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




    public function trasDoBanco($email){

    try{

    $conexao= new Conexao();
    $consulta = $conexao->conecta()->query("SELECT PX.Id as 'id_plano', PX.Name as 'name_planx', PX.RequestQuantity, PX.Price, CP.SMSCredits,C.* FROM Planx as PX inner join ClientPlan as CP on PX.Id =CP.PlanId inner join Client as C on CP.ClientId=C.Id where C.Email='$email';");
    echo $consulta;
    $retornaLista=array();
    foreach($consulta as $p){
       
        $pla = new PlanX();
       
        //$cli->fabricaClient($p['Id'],$p['Email'],$p['Password'],$p['acesstoken'],$p['Document'],$p['Name'],$p['phone']);

        $pla->fabricaPlanX($p['id_plano'],$p['name_planx'],$p['RequestQuantity'],$p['Price']);

        $clientPlan = new ClientPlan();
        $clientPlan->fabricaClientPlan($p['Id'],$pla,$p['SMSCredits']);

      array_push($retornaLista,$clientPlan);

    }
    
    return $retornaLista;
    
    
    }catch(Exception $e){

        return $e;

    }


    }

}