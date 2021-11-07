<?php

namespace Controller;

session_start();

 class ChoosePlan {
    public function get() {
       
        \Controller\Utils::renderChoosePlan();
    }

    public function post() {
        $planid = $_POST["planid"];
       // var_dump($_SESSION["otp"]);
        // \Model\Admin::approvereq( $requestid );
       // var_dump($planid);
        \Controller\Utils::renderMakePayment($planid);
        

    }
}