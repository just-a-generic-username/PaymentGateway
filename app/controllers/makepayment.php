<?php

namespace Controller;
session_start();

class MakePayment {
    public function get() {
        var_dump($_SESSION["otp"]);
        
            \Controller\Utils::renderMakePayment(1);
        
       
    }

    public function post() {
        
        $number = $_POST["phonenumber"];
        $password = $_POST["password"];
        $email = $_POST["email"];
        $otp = $_POST["otp"];
        $planid = $_POST["planid"];

     //   var_dump($planid);
        var_dump($_SESSION["otp"]);
        $isSetAll =  \Controller\Utils::isSetAll( $number, $password, $email, $planid );


        if( !$isSetAll )
        {
            $isSetOtp =  \Controller\Utils::isSetAll($otp );
             if($isSetOtp){
                $matched=\Model\Bank::matchcredentials( $password, $email, $otp );
              // var_dump($matched);
                if($matched){
                    $balenough=\Model\Bank::checkifenoughbal( $password, $email, $planid );
                    \Controller\Utils::renderPaymentSuccessful($matched, $balenough);
                    \Model\Bank::inserttransaction( $password, $email, $planid );
                
            }

             }else{
                \Model\Bank::generateotp( $password, $email );
             }        
           
           //  \Controller\Utils::renderBankHome();
            
        }
        else{
            header("Location: /chooseplan");
        }

    }
}