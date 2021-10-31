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
        $email = $_POST["email"];
        $otp = $_POST["otp"];


        $isSetAll =  \Controller\Utils::isSetAll( $number, $password, $email );


        if( !$isSetAll )
        {
            $isSetOtp =  \Controller\Utils::isSetAll($otp );
             if($isSetOtp){
                $matched=\Model\Bank::matchcredentials( $password, $email, $otp );
                if($matched){
                    \Controller\Utils::renderPaymentSuccessful();
                }

             }else{
                \Model\Bank::generateotp( $password, $email,  );
             }        
           
           //  \Controller\Utils::renderBankHome();
            
        }
        else{
            header("Location: /chooseplan");
        }

    }
}