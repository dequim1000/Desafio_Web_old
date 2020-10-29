<?php
    abstract class Planos{
        // Força a classe que estende ClasseAbstrata a definir esse método
        abstract protected function pegarGrafico();
        abstract protected function pegarQuantidade();
        abstract protected function pegarUsuario();
        abstract protected function pegarTabela( $table );
    
        // Método comum
        public function imprimirGraficos() {
            print $this->pegarGrafico();
        }
    }


    class SMS extends Planos{

        public function pegarGrafico() {
            return "Grafico SMS";
        }

        public function pegarQuantidade(){
            return "2000 SMS";
        }

        public function pegarUsuario(){
            return "Usuario André";
        }
    
        public function pegarTabela( $table ) {
            return "aqui vai uma {$table} para SMS";
        }
    }

    class Chamadas extends Planos{

        public function pegarGrafico() {
            return "Grafico Chamadas";
        }

        public function pegarQuantidade(){
            return "4000 Chamadas";
        }

        protected function pegarUsuario(){
            return "Usuario Henrique";
        }
    
        public function pegarTabela( $table ) {
            return "aqui vai uma {$table} para Chamadas";
        }
    }

    $sms = new SMS;
    $sms->imprimirGraficos();
    echo $sms->pegarGrafico()."\n";
    echo $sms->pegarQuantidade()."\n";
    echo $sms->pegarUsuario()."\n";
    echo $sms->pegarTabela('table_') ."\n";

    $call = new Chamadas;
    echo $call->imprimirGraficos()."\n";
    echo $call->pegarGrafico()."\n";
    echo $call->pegarQuantidade()."\n";
    echo $call->pegarTabela('table_') ."\n";
?>