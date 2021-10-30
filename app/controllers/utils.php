<?php

namespace Controller;
session_start();

class Utils {
    public static function isSetAll(...$values)
    {
        $flag=true;
        foreach($values as $v)
            if(empty($v) || !isset($v))
                $flag=false;
        return $flag;
    }

    public static function renderBankHome(){
        echo \View\Loader::make()->render("templates/bankhome.twig", array(
           
        ));
    }

    public static function renderBankLogin(){
        echo \View\Loader::make()->render("templates/banklogin.twig", array(
        //    "posts" => \Model\User::get_all(),
            "notloggedin" => true,
        ));
    }

    public static function renderClientHome(){
        echo \View\Loader::make()->render("templates/clienthome.twig" ,array(
            // "bookdata" => \Model\User::get_allbooks(),
            // "pendingrequests" =>  \Model\User::showpendingrequests(),
            // "ownedbooks" =>  \Model\User::get_ownedbooks(),
            )); 
    }

    public static function renderHome(){
        echo \View\Loader::make()->render("templates/home.twig", array(
           
        ));
    }

    public static function renderLogin(){
        echo \View\Loader::make()->render("templates/login.twig", array(
            "notloggedin" => true,
        ));
    }

    public static function renderBankReg(){
        echo \View\Loader::make()->render("templates/bankreg.twig", array(
           
            "notloggedin" => true,
        ));
    }

    public static function renderChoosePlan(){
        echo \View\Loader::make()->render("templates/chooseplan.twig", array(
            "plans" => \Model\User::getallplans(),
            "notloggedin" => true,
        ));
    }

    public static function renderMakePayment($planid){
        echo \View\Loader::make()->render("templates/makepayment.twig", array(
            "plans" => \Model\User::getallplans(),
            "otpexist" => $_SESSION["otpexist"],
        ));
    }



}