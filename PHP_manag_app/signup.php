<?php
include("connect.php");
session_start();

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $check_sql = "SELECT * FROM users WHERE email = ?";
    $check_stmt = $dbh->prepare($check_sql);
    $check_stmt->bindParam(1, $email);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(1, $username); 
        $stmt->bindParam(2, $email); 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt->bindParam(3, $hashed_password); 
        $res = $stmt->execute();

        if ($res) {
            $_SESSION["signup"]=true;
            header("Location: login/login.php");
            exit();
        } else {
            
            echo "<script>alert('Signup failed!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
    background-color: #f8f9fa;
}

.container {
    height: 100%;
}
.form-control{
    border-radius: 20px;

}
.card {
    border: none;
    border-radius: 20px;
}

.btn-primary {
    background-color: #007bff;
    border: none;
    border-radius: 20px;
}
.btn-primary:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6">
                <div class="card p-4 shadow">
                    <h2 class="text-center mb-4">Sign Up</h2>
                    <form method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" name="submit" class="btn btn-primary">Sign Up</button>
                            <a href="login/login.php">already have an account ?</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
