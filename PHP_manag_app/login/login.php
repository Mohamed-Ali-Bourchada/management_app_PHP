<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../css/style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>


<body>
<?php
session_start();

if(isset($_SESSION["signup"])){
    echo "<script>
        Swal.fire({
            position: 'top-center',
            icon: 'success',
            title: 'Signup Valid',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";

    unset($_SESSION['signup']);
}

if(isset($_SESSION["valideLogin"])){
    echo "<script>
        Swal.fire({
            position: 'top-center',
            icon: 'error',
            title: 'Login Failed. Please check your username or password',
            showConfirmButton: false,
            timer: 1500
        });
    </script>";

    unset($_SESSION['valideLogin']);
}
?>

<div class="container">           
   <div class="form login">
                <div class="form-content">
                    <header>Login</header>
                    <form method="POST" action="valide.php">
                        <div class="field input-field">
                            <input type="email" name="email" placeholder="Email" class="input" required>
                        </div>

                        <div class="field input-field">
                            <input type="password" name="password" id="password"placeholder="Password" class="password" required>
                           
                        </div>

                        <div class="form-link">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                        </div>

                        <div class="field button-field">
      <button type="submit" name ="submit">Login</button>

                        </div>
                    </form>

                    <div class="form-link">
                        <span>Don't have an account? <a href="../signup.php" class="link signup-link">Signup</a></span>
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
                        <img src="../images/google.png" alt="" class="google-img">
                        <span>Login with Google</span>
                    </a>
                </div>

            </div>
</section>

<!-- Bootstrap JS and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
