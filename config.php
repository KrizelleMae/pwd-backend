
<?php

    session_start();
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Credentials: true");
    
    date_default_timezone_set("Asia/Manila");
    
    $db = mysqli_connect("localhost", "root","","pwd_db");
    // $db = mysqli_connect("localhost", "u769999889_zcmcreferral", "Zcmcref@2022","u769999889_zcmcreferral");

    if($db === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    } 
    
    //  date_default_timezone_set("Asia/Singapore");


?>