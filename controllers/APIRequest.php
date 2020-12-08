<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/ApiRequest_model.php';

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
            'NamePlan' =>$s->getPlanId()->getName(),
            'Dtrequest' =>$s->getDtrequest(),
            'Url' =>$s->getUrl(),
            'Body' =>$s->getBody(),
            'Request' =>$s->getRequest(),
            'Restante' =>$s->getRestantes(),
            'ResponseBody' =>$s->getResponsebody(),
            'ResponseStatus' =>$s->getStatus(),
            'Post' =>$s->getPost(),
        );
    }

    foreach($consultaCALL as $c){
        $retorno[]=array(
            'idApiRequest' =>$c->getId(),
            'idClient' =>$c->getClientId(),
            'idPlan' =>$c->getPlanId()->getId(),
            'NamePlan' =>$c->getPlanId()->getName(),
            'ContractedQuantityCall' =>$c->getPlanId()->getRequestsQuantity(),
            'PriceCall' =>$c->getPlanId()->getPrice(),
            'Dtrequest' =>$c->getDtrequest(),
            'Url' =>$c->getUrl(),
            'PriceToCall' =>$c->getPriceCall(),
            'Body' =>$c->getBody(),
            'Request' =>$c->getRequest(),
            'Restante' =>$c->getRestantes(),
            'Extras' =>$c->getExtras(),
            'ResponseBody' =>$c->getResponsebody(),
            'ResponseStatus' =>$c->getStatus(),
            'Post' =>$c->getPost(),
        );
    }

    ob_clean();
    echo json_encode($retorno);
?>
