<?php

require __DIR__."/../vendor/autoload.php";

// echo phpinfo();
Toro::serve(array(
    "/" => "\Controller\Home",
    "/post/:number" => "Controller\Post",
    "/login" => "Controller\Login",
    "/clienthome" => "Controller\Clienthome",
    "/banklogin" => "Controller\Banklogin" ,
    "/bankhome" => "Controller\Bankhome" ,
    "/logout" => "Controller\Logout" ,
    "/bankreg" => "Controller\BankReg" ,
    "/chooseplan" => "Controller\ChoosePlan" ,
    "/makepayment" => "Controller\MakePayment",
    "/paymentsuccess" => "Controller\PaymentSuccessful",
    "/showtransactions" => "Controller\ShowTransactions",
    "/depositmoney" => "Controller\DepositMoney",

));

