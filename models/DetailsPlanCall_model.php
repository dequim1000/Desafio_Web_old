<?php
require_once 'Planx_model.php';
require_once 'ClientPlan_model.php';
require_once 'conexao.php';
require_once 'Client_model.php';



class DetailsSms{
    private $id;
    private $clientId;
    private $planId;
    private $dtRequest;
    private $url;
    private $requestPlan;
    private $restantePlan;

    public function fabricaDetailsSms($id,$clientId,$planId,$dtRequest,$url,$requestPlan,$restantePlan){
        $this->id=$id;
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->dtRequest=$dtRequest;
        $this->url=$url;
        $this->requestPlan=$requestPlan;
        $this->restantePlan=$restantePlan;
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
    public function getRequest(){
        return $this->requestPlan;
    }
    public function getRestantes(){
        return $this->restantePlan;
    }
    
    public function trasDoBancoSMS($planid, $clientid){

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
                    WHERE CPR.ClientId  = '$clientid'
                    AND CPR.URL LIKE '%/api/sms/send%'
                    AND CPR.RESPONSESTATUS = 200
                    and Month(CPR.DtRequest) = month(sysdate())
                    group by CPR.PlanId;";

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
                    $cliApi->fabricaApirequest($api['IDAPIREQUEST'],$api['CLIENTID'],$planx, $api['DTREQUEST'],$api['URL'],$api[''],$api['BODY'],$api['RESPONSESTATUS'],$api['UTILIZADOS'],$api['RESTANTES'],$api[''], $api['RESPONSEBODY'],$api['POSTACTIONS'] );
                    array_push($ret,$cliApi );
                }

                return $ret;
        } catch (Exception $e) {
            return $e;
        }
    }

public function trasDoBancoCALL($planid, $clientid){

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
        AND MONTH(CPR.DTREQUEST) = MONTH(SYSDATE())
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
                    $cliApi = new Apirequest();
                    $cliApi->fabricaApirequest($api['IDAPIREQUEST'],$api['CLIENTID'],$planx, $api['DTREQUEST'],$api['URL'],$api['UTIQUANTITY'],$api['BODY'],$api['RESPONSESTATUS'],$api['UTILIZADOS'],$api['RESTANTES'],$api['EXTRAS'],$api['RESPONSEBODY'],$api['POSTACTIONS'] );
                    array_push($ret,$cliApi );
                }

                return $ret;
        } catch (Exception $e) {
            return $e;
        }
}

}