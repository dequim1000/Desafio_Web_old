<?php
require_once 'Planx_model.php';
require_once 'ClientPlan_model.php';
require_once 'conexao.php';
require_once 'Client_model.php';



class Apirequest{
    private $id;
    private $clientId;
    private $planId;
    private $dtRequest;
    private $url;
    private $body;
    private $responseStatus;
    private $responseBody;
    private $postActions;
    private $requestPlan;
    private $restantePlan;

    public function fabricaApirequest($id,$clientId,$planId,$dtRequest,$url,$body,$responseStatus,$requestPlan,$restantePlan,$responseBody,$postActions){
        $this->id=$id;
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->dtRequest=$dtRequest;
        $this->url=$url;
        $this->body=$body;
        $this->responseStatus=$responseStatus;
        $this->requestPlan=$requestPlan;
        $this->restantePlan=$restantePlan;
        $this->responseBody=$responseBody;
        $this->postActions=$postActions;
    }

    public function getId(){
        return $this->id;
    }

    public function getClientId(){
        return $this->clientId;

    }
    public function getPlanId(){
        return $this->planId;
    }

    public function getDtrequest(){
        return $this->dtRequest;
    }
    public function getUrl(){
        return $this->url;
    }
    public function getBody(){
        return $this->body;
    }
    public function getStatus(){
        return $this->responseStatus;
    }
    public function getRequest(){
        return $this->requestPlan;
    }
    public function getRestantes(){
        return $this->restantePlan;
    }
    public function getResponsebody(){
        return $this->responseBody;
    }
    public function getPost(){
        return $this->postActions;
    }

    public function URLTipo(){
        $TipoUrl = "teste";
        //$conexaoUrl = new Conexao();
        //$TipoUrl = $conexaoUrl->conecta()->query("SELECT apr.ClientId as 'ID Client',
        //apr.URL as 'URL' FROM ClientApiRequest as apr where apr.Id = '$idApirequest' ;");
        return $TipoUrl;
    }
    
    public function trasDoBanco($tipoPlano, $planid, $clientid){
                
        if ($tipoPlano == '%/api/call/send%'){

            $SQLTipo = " SELECT C.NAME AS 'CLIENTE'
            , PLA.ID AS 'PLANOID'
            , PLA.NAME AS 'PLANONAME'
            , PLA.PRICE AS 'PRICE'
            , PLA.REQUESTQUANTITY AS 'REQUESTQUANTITY'
            , (PLA.PRICE / PLA.REQUESTQUANTITY) AS 'UTIQUANTITY'
            , COUNT(CPR.ID) AS 'UTILIZADOS'
            , CP.SMSCREDITS AS 'SMSCONTRATADOS'
            , CP.CLIENTID AS 'CLIENTID'
            , CPR.ID AS 'IDAPIREQUEST'
            , CPR.URL AS 'URL'
            , CPR.BODY AS 'BODY'
            , CPR.RESPONSESTATUS AS 'RESPONSESTATUS'
            , CPR.RESPONSEBODY AS 'RESPONSEBODY'
            , CPR.POSTACTIONS AS 'POSTACTIONS'
            , (PLA.REQUESTQUANTITY - COUNT(CPR.ID)) AS 'RESTANTES'
            , (COUNT(CPR.ID) - PLA.REQUESTQUANTITY) * - 1 AS 'EXTRAS'
            , (COUNT(CPR.ID) * (PLA.PRICE / PLA.REQUESTQUANTITY)) AS 'PREÇO TOTAL'
            , MONTH(DTREQUEST) AS 'DTREQUEST'
        FROM CLIENTPLAN AS CP
        JOIN CLIENT AS C
        ON C.ID = CP.CLIENTID
        JOIN PLANX AS PLA
        ON PLA.ID = '$planid'
        JOIN CLIENTAPIREQUEST AS CPR
        ON CPR.CLIENTID = CP.CLIENTID
        AND CPR.PLANID = PLA.ID
        WHERE CPR.CLIENTID = '$clientid'
        AND CPR.URL LIKE '%/api/call/send%'
        AND CPR.RESPONSESTATUS = 200
        AND MONTH(CPR.DTREQUEST) = MONTH(SYSDATE())
    GROUP BY CPR.PLANID;";

        }else if ($tipoPlano == '%/api/sms/send%'){
            $SQLTipo = "SELECT cp.ClientId as 'CLIENTID'
                , PLA.ID AS 'PLANOID'
                , PLA.NAME AS 'PLANONAME'
                , PLA.PRICE AS 'PRICE'
                , PLA.REQUESTQUANTITY AS 'REQUESTQUANTITY'
                , CP.CLIENTID AS 'CLIENTID'
                , cp.SMSCredits AS 'SMSCONTRATADOS'
                , count(CPR.id) as 'UTILIZADOS'
                , CPR.ID AS 'IDAPIREQUEST'
                , CPR.URL AS 'URL'
                , CPR.BODY AS 'BODY'
                , CPR.RESPONSESTATUS AS 'RESPONSESTATUS'
                , CPR.RESPONSEBODY AS 'RESPONSEBODY'
                , CPR.POSTACTIONS AS 'POSTACTIONS'
                , (cp.SMSCredits - count(CPR.id)) as 'RESTANTES'
                , MONTH(DtRequest) as 'DTREQUEST'
                    FROM ClientPlan as CP
                    JOIN ClientApiRequest as CPR 
                    on cp.ClientId = CPR.ClientId
                    JOIN PLANX AS PLA
                    ON PLA.ID = '$planid'
                    WHERE CPR.ClientId  = '1'
                    AND CPR.URL LIKE '%/api/sms/send%'
                    AND CPR.RESPONSESTATUS = 200
                    and Month(CPR.DtRequest) = month(sysdate())
                    group by CPR.PlanId;";
        }else{
            echo("PLANO NÃO ENCOTRADO");
        }

        try {
            $conexao = new Conexao();
            $consulta = $conexao->conecta()->query("".$SQLTipo);
            $ret=array();
                foreach($consulta as $api){
                    $planx = new PlanX();
                    $planx->fabricaPlanX($api['PLANOID'],$api['PLANONAME'],$api['REQUESTQUANTITY'],$api['PRICE']);
                    $clientPlan = new ClientPlan();
                    $clientPlan->fabricaClientPlan($api['CLIENTID'], $planx, $api['SMSCONTRATADOS']);
                    $cliApi = new Apirequest();
                    $cliApi->fabricaApirequest($api['IDAPIREQUEST'],$api['CLIENTID'],$planx, $api['DTREQUEST'],$api['URL'],$api['BODY'],$api['RESPONSESTATUS'],$api['UTILIZADOS'],$api['RESTANTES'],$api['RESPONSEBODY'],$api['POSTACTIONS'] );
                    array_push($ret,$cliApi );
                }

                return $ret;
        } catch (Exception $e) {
            return $e;
        }
    }
}



$tst= new Apirequest();
$url = '%/api/call/send%';
$x=$tst->trasDoBanco($url,1,1);
foreach($x as $v){
    echo "<br>";
    echo $v->getId();
    echo "<br>";
    echo $v->getClientId();
    echo "<br>";
    echo $v->getPlanId()->getId();
    echo "<br>";
    echo $v->getPlanId()->getRequestsQuantity();
    echo "<br>";
    echo $v->getRequest();
    echo "<br>";
    echo $v->getRestantes();
    echo "<br>";
    echo $v->getDtrequest();
    echo "<br>";
    echo $v->getUrl();
    
}


?>