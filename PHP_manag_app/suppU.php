<?php
session_start();
include("connect.php"); // Include database connection file

if(!isset($_SESSION['auth'])){
    header("Location: login/login.php");
    exit; // Stop further execution
}

if(isset($_GET['id'])) {
    $userId = $_GET['id'];
    // Check if the user is trying to delete their own account
    

    if($_SESSION["userId"]==$userId) {
        // USER tyring to delete main account delete it and log him out 
           $sqlDeleteUser = "DELETE FROM users WHERE UserID = :userId";
            $stmtDeleteUser = $dbh->prepare($sqlDeleteUser);
            $stmtDeleteUser->bindParam(':userId', $userId);
            $stmtDeleteUser->execute();
        header("Location: signOut.php");
        exit; // Stop further execution
    }

    // Proceed with the deletion process if the user is not deleting their own account
    $sqlDeleteUser = "DELETE FROM users WHERE UserID = :userId";
    $stmtDeleteUser = $dbh->prepare($sqlDeleteUser);
    $stmtDeleteUser->bindParam(':userId', $userId);
    $stmtDeleteUser->execute();

    // Redirect back to the user list page after deletion
    header("Location: afficheUsers.php");
    exit; // Stop further execution
} else {
    // Redirect to user list page if no user ID is provided
    header("Location: afficheUsers.php");
    exit; // Stop further execution
}
?> 
