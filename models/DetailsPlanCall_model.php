<?php
require_once 'Planx_model.php';
require_once 'ClientPlan_model.php';
require_once 'conexao.php';
require_once 'Client_model.php';



class DetailsCall{
    private $id;
    private $clientId;
    private $planId;
    private $dtRequest;
    private $priceCall;
    private $url;
    private $body;
    private $responseStatus;
    private $responseBody;
    private $postActions;
    private $requestPlan;
    private $restantePlan;
    private $extrasPlan;

    public function fabricaDetailsCall($id,$clientId,$planId,$dtRequest,$url,$priceCall,$requestPlan,$restantePlan,$extrasPlan){
        $this->id=$id;
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->dtRequest=$dtRequest;
        $this->url=$url;
        $this->priceCall=$priceCall;  
        $this->requestPlan=$requestPlan;
        $this->restantePlan=$restantePlan;
        $this->extrasPlan = $extrasPlan;
       
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
    public function getPriceCall(){
        return $this->priceCall;
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
    public function getExtras(){
        return $this->extrasPlan;
    }
    public function getResponsebody(){
        return $this->responseBody;
    }
    public function getPost(){
        return $this->postActions;
    }
    
   public function trasDoBancoCALL($planid, $clientid, $mesSelect, $anoSelect){
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
            , (COUNT(CPR.ID) - PLA.REQUESTQUANTITY) AS 'EXTRAS'
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
        AND MONTH(CPR.DTREQUEST) = $mesSelect
        AND YEAR(CPR.DTREQUEST) = $anoSelect
    GROUP BY CPR.PLANID;";

 	try {
            $conexao = new Conexao();
            $consulta = $conexao->conecta()->query("".$SQLTipo);
            $ret=array();
                foreach($consulta as $api){
                    $planx = new PlanX();
                    $planx->fabricaPlanX($api['PLANOID'],$api['PLANONAME'],$api['REQUESTQUANTITY'],$api['PRICE']);
                    $clientPlan = new ClientPlan();
                    $clientPlan->fabricaClientPlan($api['CLIENTID'], $planx, $api['SMSCONTRATADOS']);
                    $cliApi = new DetailsCall();
                    $cliApi->fabricaDetailsCall($api['IDAPIREQUEST'],$api['CLIENTID'],$planx, $api['DTREQUEST'],$api['URL'],$api['UTIQUANTITY'],$api['UTILIZADOS'],$api['RESTANTES'],$api['EXTRAS']);
                    array_push($ret,$cliApi );
                }
                return $ret;
        } catch (Exception $e) {
            return $e;
        }
}

}
