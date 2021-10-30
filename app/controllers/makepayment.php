<?php

namespace Controller;
session_start();

class MakePayment {
    public function get() {
    
        
            \Controller\Utils::renderMakePayment(1);
        
       
    }

    public function post() {
        
        $number = $_POST["phonenumber"];
        $password = $_POST["password"];
        $accountno = $_POST["accountno"];
        $otp = $_POST["otp"];


        $isSetAll =  \Controller\Utils::isSetAll( $number, $password, $accountno );


        if( !$isSetAll )
        {
            $isSetOtp =  \Controller\Utils::isSetAll($otp );
             if($isSetOtp){
                
             }else{
                \Controller\Utils::isSetAll( $number, $password, $accountno );
             }        
            \Controller\Utils::renderBankHome();
            
        }
        else{
            header("Location: /chooseplan");
        }

    }
}