<?php
    class configuracao{

        private $nome;
        private $email;
        private $senha;

        public function setUser($name, $email, $pass){
            $this->nome = $name;
            $this->email = $email;
            $this->senha = $pass;
        }

        public function getUser($name, $email, $pass){
            return $name;
            return $email;
            return $pass;
        }
    }
?>