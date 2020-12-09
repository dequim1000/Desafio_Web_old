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
    
    public function trasDoBancoSMS($planid, $clientid, $mesSelect){

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
                    and Month(CPR.DtRequest) = month('$mesSelect')
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
                    $cliApi->fabricaDetailsSms($api['IDAPIREQUEST'],$api['CLIENTID'],$planx, $api['DTREQUEST'],$api['URL'],$api['UTILIZADOS'],$api['RESTANTES']);
                    array_push($ret,$cliApi );
                }

                return $ret;
        } catch (Exception $e) {
            return $e;
        }
    }
}
