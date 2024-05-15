<?php
include("../connect.php");
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Hash the provided password
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM users WHERE Email = ?";
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(1, $email); 
    $res = $stmt->execute();
    
    if ($res) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Verify password
            if (password_verify($pass, $row['Password'])) {
                $_SESSION['auth'] = "valid";
                $_SESSION["userId"] = $row['UserID'];
                header("Location: ../home.php");
                exit; // Stop further execution after redirecting
            } else {
                $_SESSION["valideLogin"] = true;
                header("Location: login.php");
                exit; // Stop further execution after redirecting
            }
        } else {  
            $_SESSION["valideLogin"] = true;
            header("Location: login.php");
            exit; // Stop further execution after redirecting
        }
    } else {
        echo "An error occurred!";
    }
}
?>
