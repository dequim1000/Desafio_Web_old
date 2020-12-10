<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/DetailsPlanCall_model.php';

    $user = $_POST['user'];
    $planId= 1;
    $clientId =1;
    $mesSelect = $_POST['mes'];
    $anoSelect = $_POST['ano'];

    $detailscall = new DetailsCall();
    $consultaCALL = $detailscall->trasDoBancoCALL($planId,$clientId,$mesSelect,$anoSelect);
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
            'Request' =>$c->getRequest(),
            'Restante' =>$c->getRestantes(),
            'Extras' =>$c->getExtras(),
        );
    }


    ob_clean();
    echo json_encode($retorno);
?>
