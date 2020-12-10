<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/DetailsPlanSms_model.php';

    $user = $_POST['user'];
    $planId= 1;
    $clientId =1;
    $mesSelect = $_POST['mes'];
    $anoSelect = $_POST['ano'];
    
    $detailsSMS = new DetailsSms();
    $consultaSMS = $detailsSMS->trasDoBancoSMS($planId,$clientId,$mesSelect,$anoSelect);
    $retorno = array();

    foreach($consultaSMS as $s){
        $retorno[]=array(
            'idApiRequest' =>$s->getId(),
            'idClient' =>$s->getClientId(),
            'idPlan' =>$s->getPlanId()->getId(),
            'NamePlan' =>$s->getPlanId()->getName(),
            'Dtrequest' =>$s->getDtrequest(),
            'Url' =>$s->getUrl(),
            'Request' =>$s->getRequest(),
            'Restante' =>$s->getRestantes(),
        );
    }

    ob_clean();
    echo json_encode($retorno);
?>
