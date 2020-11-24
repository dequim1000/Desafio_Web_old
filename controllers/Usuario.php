<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');
include '../models/usuario_model.php';
$user=$_POST['user'];
$pass=$_POST['pass'];

$usuario = new Usuario($user,'');
if($user==$usuario->getEmail() && $pass ==$usuario->getPasswordClient()){
    $resposta = array('resposta'=>'1');
}else{
    $resposta = array('resposta'=>'0');
}

ob_clean();
echo json_encode($resposta);