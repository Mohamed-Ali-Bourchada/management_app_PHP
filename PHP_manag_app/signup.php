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
        $testEmail=false;
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
    <!-- SWEET ALERT 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>
    <?php
    if(isset($testEmail)){
         echo "<script>
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Email already exists!',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";
    }
    ?>
    <div class="container">
    <div class="form signup">
                <div class="form-content">
                    <header>Signup</header>
                    <form method="POST">
                        <div class="field input-field">
                            <input type="text"  id="username" name="username" placeholder="Username" required>
                        </div>

                        <div class="field input-field">
                            <input type="email"  id="email" name="email" placeholder="Email" required>
                        </div>

                        <div class="field input-field">
                            <input type="password"  id="password" name="password" placeholder="Password" required>
                        </div>
                         <div class="field input-field">
                            <input type="password"  id="confirmPassword" name="confirmPassword" placeholder="Confirm password" required>
                        </div>
                        <div class="field button-field">
                            <button type="submit" name="submit" >Signup</button>
                        </div>
                    </form>

                    <div class="form-link">
                        <span>Already have an account? <a href="login/login.php" class="link login-link">Login</a></span>
                    </div>
                </div>

                <div class="line"></div>

                <div class="media-options">
                    <a href="#" class="field facebook">
                        <i class='bx bxl-facebook facebook-icon'></i>
                        <span>Login with Facebook</span>
                    </a>
                </div>

                <div class="media-options">
                    <a href="#" class="field google">
                        <img src="images/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>
</div>
   

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
