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
     //       var_dump($_SESSION['bankid']);
        }else{
            echo('failed');
        }
    }

    public static function generateotp(  $password, $email) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
        

            
        if(password_verify($password ,$rows[0]['password'])){
                $six_digit_random_number = random_int(100000, 999999);
                $_SESSION['otp'] = $six_digit_random_number;
                $_SESSION['otpexist']= true;
                
                $to      = "$email";
                $subject = 'OTP generated';
                $message = "your otp is $six_digit_random_number";
                $headers = 'From: webmaster@example.com' . "\r\n" .
                    'Reply-To: webmaster@example.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        
                mail($to, $subject, $message, $headers);    
            
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
            // unset($_SESSION['Products']);
            $_SESSION['bankid'] = $rows[0]['accountno'];

            // var_dump("success");
            return true;
        }else{
            // echo('failed');
            return false;
        }
    }

    public static function inserttransaction( $password, $email, $planid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO transactions (planid , email , transaction_time ) VALUES (? ,? , now())");
        $stmt->execute([ $planid ,$email]);
        // $rows = $stmt->fetchAll();

       
      
    }

    public static function checkifenoughbal(  $password,$email ,$planid) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt->execute([$email]);
        $row = $stmt->fetch();

        
        $stmt2 = $db->prepare("SELECT * FROM plan WHERE plan_id = ? ");
        $stmt2->execute([$planid]);
        $row2 = $stmt2->fetch();
        $cost = (int)$row2["cost"];
    
     //  var_dump($cost);
      

       $balance = (int)$row["balance"];

     //  var_dump($balance);
        if($cost< $balance){
            echo ("inside method");
            $cost=$cost-$cost-$cost;
            self::depositmoney($email,$password,$cost);
            
            return true;
        }else{
            return false;
        }
        // $rows = $stmt->fetchAll();
       
        
       
      
    }




    public static function get_usersata() {
        $db = \DB::get_instance();
       
        $stmt2 = $db->prepare("SELECT * FROM bank WHERE accountno = ? ");
        $stmt2-> execute([$_SESSION['bankid']]);
        $row = $stmt2->fetch();

        
       
        return $row;

       
      
    }


    public static function depositmoney( $email, $password, $amount) {
        $db = \DB::get_instance();
        // $stmt = $db->prepare("INSERT INTO transactions (planid , email , transaction_time ) VALUES (? ,? , now())");
        // $stmt->execute([ $planid ,$email]);

        $stmt2 = $db->prepare("SELECT * FROM bank WHERE email = ? ");
        $stmt2-> execute([$email]);
        $row = $stmt2->fetch();

        $amount = $amount + $row["balance"];
        // echo("amount is ");
        // var_dump($amount);
        if( password_verify($password ,$row['password'])  ){
            $stmt2 = $db->prepare("UPDATE bank SET balance= ? WHERE email = ? ");
            $stmt2-> execute([$amount,$email]);
            return $amount;
        }

        // $rows = $stmt->fetchAll();

       
      
    }

 
    
}