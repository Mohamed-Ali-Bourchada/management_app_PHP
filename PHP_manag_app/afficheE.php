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
    <title>list of epreuves</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
   <?php
   include("navbar.php");
   ?>

    <div class="container mt-4">
        <h1 class="text-center">List of Epreuves</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Num Epreuve</th>
                    <th scope="col">Date Epreuve</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Code Mat</th>
                    <th scope="col">Libelle</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    include("connect.php");
                    $sql="SELECT E.*, M.libelle 
                          FROM epreuve AS E
                          JOIN matiere AS M 
                          ON M.codemat = E.codemat";
                    $result =$dbh-> query($sql);
                    while($row = $result ->fetch(PDO::FETCH_BOTH)){
                        echo "<tr>
                                <td>".$row[0]."</td>
                                <td>".$row[1]."</td>
                                <td>".$row[2]."</td>
                                <td>".$row[3]."</td>
                                <td>".$row[4]."</td>
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
