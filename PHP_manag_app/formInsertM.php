<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: login/login.php");
} else {
    require("connect.php");
    if (isset($_POST['submit'])) {
        $numep = $_POST["numep"];
        $dateep = $_POST["dateep"];
        $codemat = $_POST["codemat"];
        $lieu = $_POST["lieu"];
            // verifier numero epreuve
            $numep_exists_sql = "SELECT COUNT(numepreuve) FROM epreuve WHERE numepreuve = :numep";
            $numep_exists_stmt = $dbh->prepare($numep_exists_sql);
            $numep_exists_stmt->bindParam(':numep', $numep);
            $numep_exists_stmt->execute();
            $numep_row_count = $numep_exists_stmt->fetchColumn();

            if ($numep_row_count == 0) {
                $sql = "INSERT INTO epreuve VALUES (:num, :dateep, :lieu, :codemat)";
                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(':num', $numep);
                $stmt->bindParam(':dateep', $dateep);
                $stmt->bindParam(':lieu', $lieu);
                $stmt->bindParam(':codemat', $codemat);

                if ($stmt->execute()) {
                    echo "<script>alert('Epreuve ajoutée avec succès');</script>";
                } else {
                    echo "<script>alert('Une erreur s est produite lors de l ajout de l épreuve');</script>";
                }
            } else {
                echo "<script>alert('Le numéro d épreuve fourni existe déjà');</script>";
            }
        } 
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Epreuve</title>
    <!-- Bootstrap CSS -->
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
    <script src="js/script.js"></script>
</head>
<body>
        <?php
       include("navbar.php");

    ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="form-container">
                    <h2>Insert Epreuve</h2>
                    <form method="POST" onsubmit="return formE()">
                        <div class="mb-3">
                            <label for="numep" class="form-label">Num Epreuve</label>
                            <input type="number" class="form-control" id="numep" name="numep">
                        </div>
                        <div class="mb-3">
                            <label for="dateep" class="form-label">Date Epreuve</label>
                            <input type="date" class="form-control" id="dateep" name="dateep">
                        </div>
                        <div class="mb-3">
                            <label for="lieu" class="form-label">Lieu</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" >
                        </div>
                       <div class="mb-3">
    <label for="codemat" class="form-label">Code Mat</label>
    <select class="form-select" id="codemat" name="codemat">
        <option value="">Select Code Mat</option>
        <?php
        // Fetch matiere from database and populate the dropdown
        $matieres_sql = "SELECT * FROM matiere";
        $matieres_stmt = $dbh->query($matieres_sql);
        while ($matiere = $matieres_stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='".$matiere['codemat']."'>".$matiere['codemat']."</option>";
        }
        ?>
    </select>
</div>

                        <button type="submit" name="submit" class="btn btn-primary">Insert</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
