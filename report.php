<?php
    date_default_timezone_set("America/Chicago");
    
    $to      = 'youremail@email.com';
    $subject = 'Bleutrade Bot Report: '.date("F jS");
    
    set_include_path('~/trade_alg/');
    $message = file_get_contents("activity.txt", true);
    
    mail($to, $subject, $message);
?>