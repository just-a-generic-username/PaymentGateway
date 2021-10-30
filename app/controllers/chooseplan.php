<?php

namespace Controller;

session_start();

 class ChoosePlan {
    public function get() {
       
        \Controller\Utils::renderChoosePlan();
    }

    public function post() {
        $planid = $_POST["planid"];
        
        // \Model\Admin::approvereq( $requestid );
        \Controller\Utils::renderMakePayment($planid);
        

    }
}