<?php
    interface I_configuracao {
        public function setPlanos($name, $detalhes);
    
        public function getPlanos($plano);
    }
    
    
    class configuracao implements I_configuracao{

        private $planos = array();

        public function setPlanos($name, $detalhes){
            $this->planos[$name] = $detalhes;
        }

        public function getPlanos($plano){
            foreach($this->planos as $name => $value) {
                $plano = str_replace('{' . $name . '}', $value, $plano);
            }
    
            return $plano;
        }
    }
?>