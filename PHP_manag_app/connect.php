<?php
$user = 'root';
$pass= '';
$dsn= 'mysql:host=localhost;dbname=notes2' ;
try{
    $dbh= new PDO($dsn, $user, $pass);
}
catch (PDOException $e){
    print"error ! : ".$e ->getMessage()."<br/>";die();
}

?>