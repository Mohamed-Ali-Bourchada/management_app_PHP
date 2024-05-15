<?php
session_start();
if(!isset($_SESSION['auth'])){
    header("Location: login/login.php");
    exit; // Stop further execution
}

include("connect.php"); // Include database connection file

$sql = "SELECT * FROM users"; // SQL query to select all users
$result = $dbh->query($sql); // Execute the query
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script>
        function confirmDelete(event) {
            event.preventDefault(); // Prevent the default link action

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: true
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Data has been deleted.",
                        icon: "success"
                    }).then(() => {
                        // After the alert is closed, redirect the user
                        window.location.href = event.target.href;
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        showConfirmButton: false,
                        timer: 1000,
                        icon: "error"
                    });
                }
            });
        }
    </script>
</head>
<body>
<?php
include("navbar.php"); // Include navbar.php file
?>
<div class="container mt-5">
    <h1 class="text-center">List of Users</h1>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Registration Date</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>" . $row['UserID'] . "</td>
                    <td>" . $row['Username'] . "</td>
                    <td>" . $row['Email'] . "</td>
                    <td>" . $row['RegistrationDate'] . "</td>
                    <td><a href='suppU.php?id=" . $row['UserID'] . "' class='btn btn-danger btn-sm' onclick='confirmDelete(event)'>Delete</a></td>
                  </tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap Bundle with Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
