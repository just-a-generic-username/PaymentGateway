<?php

namespace Model;

session_start();

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

    public static function generateotp(  $password, $email) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
        $six_digit_random_number = random_int(100000, 999999);
        $_SESSION['otp'] = $six_digit_random_number;
        $_SESSION['otpexist']= true;
        
        $to      = 'niazzainul@gmail.com';
        $subject = 'the subject';
        $message = "your otp is $six_digit_random_number";
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

            
        if(password_verify($password ,$rows[0]['password'])){
            
            $_SESSION['bankid'] = $rows[0]['accountno'];
           // var_dump($_SESSION['bankid']);
        }else{
            echo('failed');
        }
    }

    public static function matchcredentials( $password, $email, $otp) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();

       
        if(password_verify($password ,$rows[0]['password']) && $otp == $_SESSION['otp']  ){
            session_start();
            $_SESSION['bankid'] = $rows[0]['accountno'];

            // var_dump("success");
            return true;
        }else{
            // echo('failed');
            return false;
        }
    }

 
    
}