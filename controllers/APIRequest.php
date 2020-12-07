<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/ApiRequest_model.php';

    $user = 'dequimdeveloper@gmail.com';
    $planId= 1;
    $clientId =1;
    
    
    $apiRequest = new Apirequest();
    $consultaSMS = $apiRequest->trasDoBancoSMS($planId,$clientId);
    $retornoSMS = array();
    $consultaCALL = $apiRequest->trasDoBancoCALL($planId,$clientId);
    $retornoCALL = array();

    foreach($consultaSMS as $s){
        $retornoSMS[]=array(
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
        $retornoCALL[]=array(
            'idApiRequest' =>$c->getId(),
            'idClient' =>$c->getClientId(),
            'idPlan' =>$c->getPlanId()->getId(),
            'NamePlan' =>$c->getPlanId()->getName(),
            'Quantidade Contratada Chamada' =>$c->getPlanId()->getRequestsQuantity(),
            'Preço Chamada' =>$c->getPlanId()->getPrice(),
            'Dtrequest' =>$c->getDtrequest(),
            'Url' =>$c->getUrl(),
            'Body' =>$c->getBody(),
            'Request' =>$c->getRequest(),
            'Restante' =>$c->getRestantes(),
            'ResponseBody' =>$c->getResponsebody(),
            'ResponseStatus' =>$c->getStatus(),
            'Post' =>$c->getPost(),
        );
    }

    ob_clean();
    echo json_encode($retornoSMS);

    echo json_encode($retornoCALL);
?>
