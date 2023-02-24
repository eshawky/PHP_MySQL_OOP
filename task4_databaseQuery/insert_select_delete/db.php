<?php

    $host     = "localhost";
    $user     = "root";
    $password = "";
    $dbname   = "task6";

    try 
    {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        #$conn = mysqli_connect($host, $user, $password, $dbname);

    } 
    catch (PDOException $e) 
    {
        echo "Connection failed: " . $e->getMessage();
    }

    #$sql = "insert into users (name, email,phone, password) values ('elham', 'elham@gmail.com', '0122436489','123456')";
    #$conn->exec($sql);

?>