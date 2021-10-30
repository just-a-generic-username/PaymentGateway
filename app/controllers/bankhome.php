<?php

namespace Controller;
session_start();

class Bankhome {
    public function get() {
    
        if(isset($_SESSION["bankid"])){
            \Controller\Utils::renderBankHome();
        }
        else{
            header("Location: /banklogin");
        }
       
    }

    public function post() {
        
        $title = $_POST["title"];
        $noofcopies = $_POST["noofcopies"];
        $isSetAll =  \Controller\Utils::isSetAll( $title, $noofcopies);
        if(isset($_SESSION["bankid"]) && $isSetAll )
        {

         
            \Controller\Utils::renderBankHome();
            
        }
        else if(isset($_SESSION["bankid"]) && !$isSetAll){
            \Controller\Utils::renderBankHome();
        }
        else{
            header("Location: /banklogin");
        }

    }
}