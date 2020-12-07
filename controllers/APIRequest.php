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

    foreach($consultaSMS as $p){
        $retornoSMS[]=array(
            'idApiRequest' =>$p->getId(),
            'idClient' =>$p->getClientId(),
            'idPlan' =>$p->getPlanId()->getId(),
            'NamePlan' =>$p->getPlanId()->getName(),
            'Dtrequest' =>$p->getDtrequest(),
            'SMSCreditos' =>$p->getSMSCredits(),
            'Url' =>$p->getUrl(),
            'Body' =>$p->getBody(),
            'Request' =>$p->getRequest(),
            'Restante' =>$p->getRestantes(),
            'ResponseBody' =>$p->getResponsebody(),
            'ResponseStatus' =>$p->getStatus(),
            'Post' =>$p->getPost(),
        );
    }

    foreach($consultaCALL as $p){
        $retornoCALL[]=array(
            'idApiRequest' =>$p->getId(),
            'idClient' =>$p->getClientId(),
            'idPlan' =>$p->getPlanId()->getId(),
            'NamePlan' =>$p->getPlanId()->getName(),
            'Quantidade Contratada Chamada' =>$p->getPlanId()->getRequestsQuantity(),
            'Preço Chamada' =>$p->getPlanId()->getPrice(),
            'Dtrequest' =>$p->getDtrequest(),
            'SMSCreditos' =>$p->getSMSCredits(),
            'Url' =>$p->getUrl(),
            'Body' =>$p->getBody(),
            'Request' =>$p->getRequest(),
            'Restante' =>$p->getRestantes(),
            'ResponseBody' =>$p->getResponsebody(),
            'ResponseStatus' =>$p->getStatus(),
            'Post' =>$p->getPost(),
        );
    }

    ob_clean();
    echo json_encode($retorno);
?>
