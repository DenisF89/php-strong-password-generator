<?php
session_start();

if (isset($_SESSION['password'])) {
    $password = $_SESSION['password'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Password Generata</title>
</head>
<body>

<div class="container-fluid wrapper">
    <div class="container">
        <h1 class="title">Strong Password Generator</h1>
        <h2 class="subtitle">Password Generata</h2>

        <div class="alert custom-alert alert-info text-center" role="alert">
            <?php echo $password ?? 'Nessuna password generata.'; ?>
        </div>
        <div class="d-flex justify-content-center">
            <a href="index.php" class="btn btn-primary px-4 py-2">Genera un'altra password</a>
        </div>
    </div>
</div>


</body>
</html>