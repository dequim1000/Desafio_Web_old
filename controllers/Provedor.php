<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
include '../models/provedor_model.php';

$user=$_POST['user'];
$pass=$_POST['pass'];
$cbList=$_REQUEST['name'];

$provedor = new Provedor($user,'');

if($user==$provedor->getUsername() && $pass ==$provedor->getPass() && $cbList ==$provedor->getName()){
    $resposta = array('resposta'=>'1');
}else{
    $resposta = array('resposta'=>'0');
}

ob_clean();
echo json_encode($resposta);