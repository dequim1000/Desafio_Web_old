<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/DetailsPlanSms_model.php';

    $user = 'dequimdeveloper@gmail.com';
    $planId= 1;
    $clientId =1;
    $mesSelect = '2020-12';
    
    
    $detailsSMS = new DetailsSms();
    $consultaSMS = $detailsSMS->trasDoBancoSMS($planId,$clientId,$mesSelect);
    $retorno = array();

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

    ob_clean();
    echo json_encode($retorno);
?>
