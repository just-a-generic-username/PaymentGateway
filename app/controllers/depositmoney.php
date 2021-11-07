<?php

namespace Controller;
session_start();

class DepositMoney {
    public function get() {
        \Controller\Utils::renderDepositMoney(0);
           
       
    }

    public function post() {
        
        $email = $_POST["email"];
        $password = $_POST["password"];
        $amount = $_POST["amount"];

    //    var_dump($amount);
    //    var_dump($password);
    //    var_dump($email);
        $isSetAll =  \Controller\Utils::isSetAll( $email, $password, $amount);
     //   var_dump($isSetAll);
        if($isSetAll )
        {
            $amount = \Model\Bank::depositmoney( $email, $password , $amount);
            \Controller\Utils::renderDepositMoney( $amount);
         //   var_dump($amount);
        }
        
        

    }
}