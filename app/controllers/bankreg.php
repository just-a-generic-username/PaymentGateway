<?php

namespace Controller;
session_start();

class BankReg {
    public function get() {
    
        \Controller\Utils::renderBankReg();
        // if(isset($_SESSION["adminid"])){
        //     \Controller\Utils::renderBankReg();
        // }
        // else{
        //     header("Location: /adminlogin");
        // }
       
    }

    public function post() {
        
        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $password = password_hash($password, PASSWORD_DEFAULT);
        $isSetAll = \Controller\Utils::isSetAll( $name ,$email, $password);
       
        if($isSetAll){
            \Model\Bank::create( $name ,$email, $password );
                if(isset($_SESSION["bankid"])){
                    header("Location: /bankreg");
                }
                else{
                    \Controller\Utils::renderBankReg();
                    
                }

        }
        else{
            \Controller\Utils::renderBankReg();
        }

        // \Controller\Utils::renderBankReg();
    }
}