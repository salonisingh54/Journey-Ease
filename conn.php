<?php

    $name= $_POST['name'];
    $email= $_POST['email'];
    $phone= $_POST['phone'];
    $username= $_POST['username'];
    $password= $_POST['password'];
    $city= $_POST['city'];

    $connection = mysqli_connect('localhost','root','','register_db');
    if($connection->connect_error){
        die("Connection Failed:".$connection->connect_error);
    }
    else{
        $stmt = $connection->prepare( "INSERT INTO user(name,email,phone,username,password,city) values (?,?,?,?,?,?)");
        $stmt->bind_param("ssisss",$name,$email,$phone,$username,$password,$city);
        $stmt->execute();
        echo("registration done");
        $stmt->close();
        $connection->close();
    }
?>