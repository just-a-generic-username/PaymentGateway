<?php

namespace Model;

class User {
    public static function getallplans(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM plan");
        $stmt-> execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }

    // public static function get_allbooks(){
    //     $db = \DB::get_instance();
    //     $stmt = $db->prepare("SELECT * FROM books where owner = ?");
    //     $stmt-> execute(["admin"]);
    //     $rows = $stmt->fetchAll();
    //     return $rows;
    // }

    // public static function get_ownedbooks(){
    //     $db = \DB::get_instance();
    //     $stmt2 = $db->prepare("SELECT * FROM books WHERE owner = ?");
    //     $stmt2-> execute([$_SESSION['userid']]);
    //     $rows = $stmt2->fetchAll();

       
    //     return $rows;
    // }

    public static function get_all_userdata(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt-> execute([$_SESSION['userid']]);
        $rows = $stmt->fetchAll();
        return $rows;
    }

  
    public static function login( $email, $password) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ? ");
        $stmt->execute([$email]);
        $rows = $stmt->fetchAll();
       
        if(password_verify($password ,$rows[0]['password'])){
            session_start();
            $_SESSION['userid'] = $rows[0]['id'];
           //  var_dump($_SESSION['userid']);
        }else{
            echo('failed');
        }
    }

 
    
}