<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login/login.php");
} else {
    require("connect.php");
    if (isset($_POST['submit'])) {
        $codemat = $_POST["codemat"];
        $libelle = $_POST["libelle"];
        $coef = $_POST["coef"];
        //verifier code mat
        $check_sql = "SELECT COUNT(codemat) FROM matiere WHERE codemat = :codemat";
        $check_stmt = $dbh->prepare($check_sql);
        $check_stmt->bindParam(':codemat', $codemat);
        $check_stmt->execute();
        $row_count = $check_stmt->fetchColumn();

        if ($row_count == 0) {
            $sql = "INSERT INTO matiere (codemat, libelle, coef) VALUES (:codemat, :libelle, :coef)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':codemat', $codemat);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':coef', $coef);

            if ($stmt->execute()) {
                echo "<script>alert('Matiere ajoutée avec succès');</script>";

            } else {
                echo "<script>alert('Error!');</script>";

            }
        } else {
            echo "<script>alert('Le code matière existe déjà.');</script>";

        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Matiere</title>
    <!-- Bootstrap CSS -->
    <script src="js/script.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container label {
            font-weight: bold;
        }
    </style>
</head>
<body>
           <?php
       include("navbar.php");

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h2>Insert Matiere</h2>
                    <form method="POST" onsubmit="return formM()">
                        <div class="mb-3">
                            <label for="codemat" class="form-label">Code Matiere</label>
                            <input type="text" class="form-control" id="codemat" name="codemat"  maxlength="3">
                        </div>
                        <div class="mb-3">
                            <label for="libelle" class="form-label">Libelle</label>
                            <input type="text" class="form-control" id="libelle" name="libelle">
                        </div>
                        <div class="mb-3">
                            <label for="coef" class="form-label">Coef</label>
                            <input type="text" class="form-control" id="coef" name="coef" >
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary" >Insert</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
