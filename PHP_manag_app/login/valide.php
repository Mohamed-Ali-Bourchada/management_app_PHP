<?php

include("../connect.php");
session_start();
if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $pass=$_POST['password'];
    $sql= "SELECT username, password FROM users WHERE username = ? AND password = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $username); 
    $stmt->bindParam(2, $pass); 
    $res = $stmt->execute();
    
    if ($res) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {

            $_SESSION['auth']="valide";
            header("Location: ../home.php");
        } else {  
            $_SESSION["valideLogin"]=true;
            header("Location: login.php") ;          
        }
    } else {
        echo "An error occurred!";
    }
    }
?>