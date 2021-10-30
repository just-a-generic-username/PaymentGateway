<?php

namespace Controller;
session_start();

class Banklogin {
    public function get() {
   
        if(isset($_SESSION["adminid"])){
            header("Location: /adminhome");
        }
        else{
            \Controller\Utils::renderBankLogin(); 
        }
       
    }

    public function post() {
   
        $email = $_POST["email"];
        $password = $_POST["password"];
        $isSetAll = \Controller\Utils::isSetAll( $email, $password);
       
        if($isSetAll){
            \Model\Bank::login( $email, $password );
                if(isset($_SESSION["adminid"])){
                    header("Location: /adminhome");
                }
                else{
                    \Controller\Utils::renderBankLogin();
                    
                }

        }
        else{
            \Controller\Utils::renderBankLogin();
        }
        
    }
}