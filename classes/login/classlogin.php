<?php

Class Login{
 
    function __construct(){
       $objConnection = new Connection();
    }
  
    function verificarLogado(){
       if(!isset($_SESSION["logado"])){
          header("Location: dirname(_FILE_)/../login.php");
          exit();
       }
    }
  
    function Logar($email,$senha){
       $email_usuario = mysql_query("select * from usuario where usuario.email ='".$email."'");
  
       if(mysql_num_rows($email_usuario) == 1){
          $d_usuario = mysql_fetch_array($email_usuario);
          if($d_usuario["senha"] == $senha){
             $_SESSION["id_usuario"] = $d_usuario["id"];
             $_SESSION["logado"] = "sim";
             header("Location: dirname(_FILE_)/../views/dashboard.php");
          }else{
             $Erro = "Senha e/ou Email errado(s)!";
             return $Erro;
          }
       }else{
          $Erro = "Senha e/ou Email errado(s)!";
          return $Erro;
       };
    }
}

?>
