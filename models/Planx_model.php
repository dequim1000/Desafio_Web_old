<?php

class PlanX{
    
    private $id;
    private $name;
    private $requestsQuantity;
    private $price;


    public function fabricaPlanX($id,$name,$requestsQuantity,$price){

        $this->id=$id;
        $this->name=$name;
        $this->requestsQuantity=$requestsQuantity;
        $this->price=$price;

    }

    public function getId(){

        return $this->id;
    }

    public function getName(){

        return $this->name;
    }
    public function getRequestsQuantity(){
        return $this->requestsQuantity;
    }
    public function getPrice(){
        return $this->price;
    }

}