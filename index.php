<!-- Milestone 1
Creare un form che invii in GET la lunghezza desiderata della password. 
Una nostra funzione utilizzerà questo dato per generare una password casuale 
(composta da lettere minuscole, maiuscole, numeri e/o simboli) della lunghezza specificata, da restituire all’utente.
Scirivamo tutta la logica ed il layout in un unico file index.php 

Milestone 2
Verificato il corretto funzionamento del nostro codice, 
spostiamo la logica in un file functions.php, che includeremo poi nella pagina principale.
-->



<?php
require_once 'functions.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>php-strong-password-generator</title>
</head>
<body>


<form action="" method="GET">
    <label for="length">Lunghezza password:</label>
    <input type="number" id="length" name="length" min="8" max="20"
    value=<?php echo $_GET['length']??""?>>
        <button type="submit">Genera Password</button>
</form>

<?php if (isset($_GET['length']) && $_GET['length'] != ""){
   echo "<p>Password generata: ". generatePassword() ."</p>";
   }
?>
    
</body>
</html>