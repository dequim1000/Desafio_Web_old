<?php
    abstract class DashboardAbstract{
        // Força a classe que estende ClasseAbstrata a definir esse método
        abstract protected function pegarGrafico();
        abstract protected function pegarTabela( $table );
    
        // Método comum
        public function imprimirGraficos() {
            print $this->pegarGrafico();
        }
    }


    class Dashboard extends DashboardAbstract{

        protected function pegarGrafico() {
            return "Grafico 1";
        }
    
        public function pegarTabela( $table ) {
            return "aqui vai uma {$table}";
        }
    }

    $dashBoard = new Dashboard;
    $dashBoard->imprimirGraficos();
    echo $dashBoard->pegarTabela('table') ."\n";
?>