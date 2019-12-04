<?php
declare(strict_types=1);
require_once "../../../wp-load.php";

 if (!empty($_POST)) {
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $subject = htmlspecialchars($_POST['subject']);
     $message = htmlspecialchars($_POST['message']);

     global $wpdb;
     try {
         $table_name = $wpdb->prefix . 'feedbacks';
         $wpdb->insert($table_name, array(
             'name' => $name,
             'email' => $email,
             'subject' => $subject,
             'text' => $message
         ));
         echo 'Thank you for your feedback!';
     } catch (Exception $e){
         echo $e;
     }
 }
