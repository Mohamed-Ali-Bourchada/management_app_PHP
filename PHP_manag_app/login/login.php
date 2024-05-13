
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <!-- sweet alert cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Custom CSS */
    body {
      background-color: #f8f9fa;
    }
    .login-container {
      max-width: 400px;
      margin: auto;
      margin-top: 100px;
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.1);
    }
    .login-container h2 {
      color: #333;
      text-align: center;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 20px;
    }
    .btn-primary {
      border-radius: 20px;
      background-color: #007bff;
      border: none;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .signup{
      color:green;
      font-weight:bold;
      font-size:12px;
      text-align:center
    }
  </style>

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
  <div class="login-container">
    <h2>Login</h2>
    <form method="post" action="valide.php">
      <div class="form-group">
        <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
      </div>
     
      <button type="submit" name ="submit"class="btn btn-primary btn-block">Login</button>
   
      <a href="../signup.php">dont have an account?</a>

    </form>
  </div>
</div>

<!-- Bootstrap JS and jQuery -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
