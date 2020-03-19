<?php
declare(strict_types=1);
require_once "../../../wp-load.php";
global $wpdb;

 if (!empty($_POST)) {
     $name = htmlspecialchars($_POST['name']);
     $email = htmlspecialchars($_POST['email']);
     $subject_id = htmlspecialchars($_POST['subject']);
     $message = htmlspecialchars($_POST['message']);

     add_action('phpmailer_init', function($phpmailer) use ($name, $email) {
         $phpmailer->From = $email;
         $phpmailer->FromName= $name;
     });

     $sql = "SELECT subject, email FROM wp_subjects WHERE id = {$subject_id}";
     $results = $wpdb->get_results($sql);
     $subject = $results[0]->subject;
     $subject_email = $results[0]->email;
     $headers = array('Content-Type: text/html; charset=UTF-8');

     wp_mail( $subject_email, $subject, $message, $headers );

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
