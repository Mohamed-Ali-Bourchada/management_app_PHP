 <?php
session_start();
if(!isset($_SESSION['auth'])){
header("Location: login/login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matiere List</title>
     <!-- sweet alert cdn -->
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
       include("navbar.php");

    ?>
    <div class="container mt-5">
        <h1 class="text-center">List of Matieres</h1>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Code Matiere</th>
                    <th scope="col">Libelle</th>
                    <th scope="col">Coef</th>
                    <th scope="col">Suppression</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include("connect.php");
                $sql = "SELECT * FROM matiere";
                $result = $dbh->query($sql);
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
             echo "<tr>
        <td>" . $row['codemat'] . "</td>
        <td>" . $row['libelle'] . "</td>
        <td>" . $row['coef'] . "</td>
        <td><a href='suppM.php?t=" . $row['codemat'] . "' class='btn btn-danger btn-sm' onclick='confirmDelete(event)'>Supprimer</a></td>
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
