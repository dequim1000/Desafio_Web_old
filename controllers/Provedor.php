<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
require_once '../models/ClientApi_model.php';

$clientId = $_POST['idClient'];
$novo=$_POST['tipo'];
$provedor = new ClientApi();
$resposta = array();
if($novo == 1){
    $select=$_POST['ApiId'];
    $user=$_POST['user'];
    $pass=$_POST['pass'];
    try {
        $provedor->fabricaClientApi($clientId,$select,$user,$pass,null);
        $provedor->incluirNoBanco();
        

    } catch (Exception $th) {
        
    }
    
    
}else if ($novo == 2){
    $consulta = $provedor->trasDoBanco($clientId);
    foreach ($consulta as $a) {
        $resposta[]=array(
            'idClient' =>$a->getClientId(),
            'idApi' =>$a->getApiId(),
            'user' =>$a->getUsername(),
            'pass' =>$a->getPassword(),
            'name' =>$a->getNome(),
        );
    }
}else if($novo == 3){
    $select=$_POST['idApi'];
    $provedor->excluirNoBanco($clientId,$select);

}

ob_clean();
echo json_encode($resposta);
?>
