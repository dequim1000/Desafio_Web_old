<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/DetailsPlanCall_model.php';

    $user = 'dequimdeveloper@gmail.com';
    $planId= 1;
    $clientId =1;
    $mesSelect = '2020-12';
    
    
    $detailscall = new DetailsCall();
    $consultaCALL = $detailscall->trasDoBancoCALL($planId,$clientId,$mesSelect);
    $retorno = array();

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
