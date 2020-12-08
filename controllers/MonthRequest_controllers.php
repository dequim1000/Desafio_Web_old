<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/MonthRequest_model.php';

    $user = 'dequimdeveloper@gmail.com';
    $planId= 1;
    $clientId =1;
    
    
    $apiRequest = new Apirequest();
    $consultaSMS = $apiRequest->trasDoBancoSMS($planId,$clientId);
    $retorno = array();
    $consultaCALL = $apiRequest->trasDoBancoCALL($planId,$clientId);
    $retornoCALL = array();

    foreach($consultaSMS as $s){
        $retorno[]=array(
            'idApiRequest' =>$s->getId(),
            'idClient' =>$s->getClientId(),
            'idPlan' =>$s->getPlanId()->getId(),
            'Dtrequest' =>$s->getDtrequest(),
            'Url' =>$s->getUrl(),
            'Request' =>$s->getRequest(),
            
        );
    }

    foreach($consultaCALL as $c){
        $retorno[]=array(
            'idApiRequest' =>$c->getId(),
            'idClient' =>$c->getClientId(),
            'idPlan' =>$c->getPlanId()->getId(),
            'Dtrequest' =>$c->getDtrequest(),
            'Url' =>$c->getUrl(),
            'Request' =>$c->getRequest(),
        );
    }

    ob_clean();
    echo json_encode($retorno);
?>
