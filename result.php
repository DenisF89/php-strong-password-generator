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
    <title>Password Generata</title>
</head>
<body>
    <h1>Password Generata</h1>
    <p>
        <?php echo $password ?? ''; ?>
    </p>
</body>
</html>