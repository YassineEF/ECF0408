<?php
    
    $host = 'localhost';
    $dbName = 'ecfexamens';
    $dbUser = 'root';
    $dbPassword = '';

    try{
        $db = new PDO("mysql:host=$host;dbname=$dbName",$dbUser,$dbPassword);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected Successfully!<br>"; 
    }catch(PDOException $e){
        echo 'Connection Failed: '. $e->getMessage();
    }