<?php

namespace Model;

class Bank {
    public static function get_all(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt-> execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    public static function create($name, $email, $password) {
        $db = \DB::get_instance();
        $stmt2 = $db->prepare("SELECT email FROM bank WHERE email = ? ");
        $stmt2-> execute([$email]);
        $emailexist = $stmt2->fetch();
        // var_dump($emailexist);
        $stmt = $db->prepare("INSERT INTO bank (name , email , password ) VALUES (? ,? , ?)");
        if( !empty($emailexist) ){
            var_dump("email already exists");
        }else{
            $stmt->execute([$name, $email, $password]);
        }

        
    }


    public static function login( $email, $password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
       
        if(password_verify($password ,$rows[0]['password'])){
            session_start();
            $_SESSION['bankid'] = $rows[0]['accountno'];
            var_dump($_SESSION['bankid']);
        }else{
            echo('failed');
        }
    }

    public static function generateotp( $email, $password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
        $six_digit_random_number = random_int(100000, 999999);
        $_SESSION['otp'] = $six_digit_random_number;
       
        if(password_verify($password ,$rows[0]['password'])){
            session_start();
            $_SESSION['bankid'] = $rows[0]['accountno'];
           // var_dump($_SESSION['bankid']);
        }else{
            echo('failed');
        }
    }


 
    
}