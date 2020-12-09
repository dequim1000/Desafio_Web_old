<?php
require_once 'Planx_model.php';
require_once 'ClientPlan_model.php';
require_once 'conexao.php';
require_once 'Client_model.php';



class Monthrequest{
    private $id;
    private $clientId;
    private $planId;
    private $dtRequest;
    private $url;
    private $requestPlan;

    public function fabricaMonthrequest($id,$clientId,$planId,$dtRequest,$url,$requestPlan){
        $this->id=$id;
        $this->clientId=$clientId;
        $this->planId=$planId;
        $this->dtRequest=$dtRequest;
        $this->url=$url;
        $this->requestPlan=$requestPlan;
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
    public function trasDoBancoSMS($planid, $clientid){

            $SQLTipo = "SELECT cpr.Id as 'IDREQUEST'
                , PLA.ID AS 'PLANOID'   
                , CP.CLIENTID AS 'CLIENTID'                
                , count(CPR.id) as 'UTILIZADOS'                
                , CPR.URL AS 'URL'             
                , MONTH(DtRequest) as 'DTREQUEST'
                    FROM ClientPlan as CP
                    JOIN ClientApiRequest as CPR 
                    on cp.ClientId = CPR.ClientId
                    JOIN PLANX AS PLA
                    ON PLA.ID = '$planid'
                    WHERE CPR.ClientId  = '$clientid'
                    AND CPR.URL LIKE '%/api/sms/send%'
                    AND CPR.RESPONSESTATUS = 200                    
                    group by Month(CPR.DtRequest);";

        try {
            $conexao = new Conexao();
            $consulta = $conexao->conecta()->query("".$SQLTipo);
            $ret=array();
                foreach($consulta as $api){
                    $cliApi = new Monthrequest();
                    $cliApi->fabricaMonthrequest($api['IDREQUEST'],$api['CLIENTID'],$api['PLANOID'], $api['DTREQUEST'],$api['URL'],$api['UTILIZADOS']);
                    array_push($ret,$cliApi );
                }
                return $ret;
        } catch (Exception $e) {
            return $e;
        }
    }

public function trasDoBancoCALL($planid, $clientid){

	    $SQLTipo = " SELECT CP.CLIENTID AS 'CLIENTID'
            , PLA.ID AS 'PLANOID'
            , PLA.REQUESTQUANTITY AS 'REQUESTQUANTITY'
            , COUNT(CPR.ID) AS 'UTILIZADOS'
            , CPR.ID AS 'IDAPIREQUEST'
            , CPR.URL AS 'URL'
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
    GROUP BY MONTH(CPR.DTREQUEST);";

 	try {
            $conexao = new Conexao();
            $consulta = $conexao->conecta()->query("".$SQLTipo);
            $ret=array();
                foreach($consulta as $api){
                    $cliApi = new Monthrequest();
                    $cliApi->fabricaMonthrequest($api['IDAPIREQUEST'],$api['CLIENTID'],$api['PLANOID'], $api['DTREQUEST'],$api['URL'],$api['UTILIZADOS']);                    
                    array_push($ret,$cliApi );
                }

                return $ret;
        } catch (Exception $e) {
            return $e;
        }
}

}
