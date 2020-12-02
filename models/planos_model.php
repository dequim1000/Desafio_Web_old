<?php

require_once 'conexao.php';

    class Provedor{
        private $id;
        public $clientId;
        private $namePlan;
        private $monthlyValue;
        private $requestValue;
        private $contractedQuantity;
        private $extraQuantity;



        private function fabricaPlanos($id, $clientId, $namePlan, $monthlyValue, $requestValue, $contractedQuantity, $extraQuantity){
            $this->id = $id;
            $this->clientId = $clientId;
            $this->namePlan = $namePlan;
            $this->monthlyValue = $monthlyValue;
            $this->requestValue = $requestValue;
            $this->contractedQuantity = $contractedQuantity;
            $this->extraQuantity = $extraQuantity;
        }

        public function requesDatabase($iden,$pass){
            $conexao = new Conexao();

            $consulta = $conexao->conecta()->query("SELECT cp.ClientId, cp.NamePlan, cp.MonthlyValue, cp.Requestvalue, cp.ContractedQuantity, cp.ExtraQuantity, count(cpr.id) as 'utilizados', ((cp.ContractedQuantity + cp.ExtraQuantity) - count(cpr.id)) as 'restantes'
            FROM ClientPlan as cp
            JOIN ClientApiRequest as cpr
            ON cp.id = cpr.PlanId
                And cp.ClientId = cpr.ClientId
            WHERE cpr.ClientId = '1'
                And Month(cpr.dt_request) = month(sysdate())
            group by cpr.PlanId");

            foreach($consulta as $us){
                $this->id = $us["Id"];
                $this->clientId = $us["ClientId"];
                $this->namePlan = $us["NamePlan"];
                $this->monthlyValue = $us["MonthlyValue"];
                $this->requestValue = $us["Requestvalue"];
                $this->contractedQuantity = $us["ContractedQuantity"];
                $this->extraQuantity = $us["ExtraQuantity"];
            }
        }

        
        public function getId(){
            return  $this->id;
        }

        public function getClientId(){
            return $this->clientId;
        }

        public function getNamePlan(){
            return $this->namePlan;
        }

        public function getMonthlyValue(){
            return $this->monthlyValue;
        }

        public function getRequestValue(){
            return $this->requestValue;
        }

        public function getQtdecontratada(){
            return $this->contractedQuantity;
        }

        public function getExtra(){
            return $this->extraQuantity;
        }
    }