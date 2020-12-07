<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/ClientPlan_model.php';

    $user = 'dequimdeveloper@gmail.com';

    $clientPlan = new ClientPlan();
    $consulta = $clientPlan->trasDoBanco($user);
    $retorno = array();

    foreach($consulta as $p){
        $retorno[]=array(
            'idClient' =>$p->getClientId(),
            'idPlan' =>$p->getPlanId()->getId(),
            'NamePlan' =>$p->getPlanId()->getName(),
            'Quantidade Contratada' =>$p->getPlanId()->getRequestsQuantity(),
            'Preço Chamada' =>$p->getPlanId()->getPrice(),
            'SMSCreditos' =>$p->getSMSCredits(),
        );
    }

    ob_clean();
    echo json_encode($retorno);
?>