<?php

include 'conexao.php';

class Provedor{

    public  $clientId;
    private $smtpUsername;
    private $smtpHost;
    private $smtpPassword;
    private $smtpPort;
    private $trackingemailTemplate;
    private $trackingemailEventTemplate;

    public function Provedor($iden,$pass){
        $this->montaProvedor($iden,$pass);
    
    }

    private function montaProvedor($iden,$pass){
        $conexao = new Conexao();

        $consulta=$conexao->conecta()->query("SELECT * FROM ClientConfiguration WHERE SMTPUsername='$iden'");
       
        foreach($consulta as $us){
        $this->clientId=$us["ClientId"];
        $this->smtpUsername=$us["SMTPUsername"];
        $this->smtpPassword=$us["SMTPPassword"];
        $this->smtpHost=$us["SMTPHost"];
        $this->smtpPort=$us["SMTPPort"];
        $this->trackingemailTemplate=$us["TrackingEmailTemplate"];
        $this->trackingemailEventTemplate=$us["TrackingEmailEventTemplate"];
        }

    }

    public function getClientId(){
        return $this->clientId;
    }

    public function getUser(){
        return $this->smtpUsername;
    }

    public function getHost(){
        return $this->smtpHost;
    }

    public function getPass(){
        return $this->smtpPassword;
    }

    public function getPort(){
        return $this->smtpPort;
    }

    public function getTemplate(){
        return $this->trackingemailTemplate;
    }

    public function getEventTemplate(){
        return $this->trackingemailEventTemplate;
    }
}
