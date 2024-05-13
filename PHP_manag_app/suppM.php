<?php
require("connect.php");
$k=$_GET['t'];
$sql= "delete from matiere where codemat='$k'";    
$result=$dbh->exec($sql);
if($result){
    header("Location: afficheM.php");

    echo "valide ";
}
else{
    header("Location: afficheM.php");

    echo "non valide";

}



?>