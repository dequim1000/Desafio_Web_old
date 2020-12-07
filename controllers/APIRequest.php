<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/ApiRequest_model.php';

    $user = 'dequimdeveloper@gmail.com';
    $planId= 1;
    $clientId =1;
    
    
    $apiRequest = new Apirequest();
    $consulta = $apiRequest->trasDoBanco($url,$planId,$clientId);
    $retorno = array();

    foreach($consulta as $p){
        $retorno[]=array(
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
