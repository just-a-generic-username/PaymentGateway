<?php

namespace Controller;
session_start();

class PaymentSuccessful {
    public function get() {
        \Controller\Utils::renderPaymentSuccessful();
    }

    public function post() {
        \Controller\Utils::renderPaymentSuccessful();
        
    }
}