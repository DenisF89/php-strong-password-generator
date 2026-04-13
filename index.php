<?php
/*  
Milestone 1
Creare un form che invii in GET la lunghezza desiderata della password. 
Una nostra funzione utilizzerà questo dato per generare una password casuale 
(composta da lettere minuscole, maiuscole, numeri e/o simboli) della lunghezza specificata, da restituire all’utente.
Scirivamo tutta la logica ed il layout in un unico file index.php 

Milestone 2
Verificato il corretto funzionamento del nostro codice, 
spostiamo la logica in un file functions.php, che includeremo poi nella pagina principale.

Milestone 3 (BONUS)
Invece di visualizzare la password generata nella stessa pagina (index.php), 
effettuiamo un redirect ad una seconda pagina (result.php), dedicata proprio a mostrare il risultato. 
Questa pagina riceverà la password che era stata generata tramite sessione e la mostrerà all’utente.

Milestone 4 (BONUS)
Gestire ulteriori parametri nel form per le password, dando la possibilità all’utente di specificare 
quali set di caratteri possono essere ammessi nella password da generare, tra lettere maiuscole, lettere minuscole, numeri e simboli.
*/

session_start();

require_once 'functions.php';

if (isset($_GET['length']) && $_GET['length'] != ""){
    $_SESSION['password'] = generatePassword();
    header('Location: result.php');
}

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
    <br>
    <label for="repeat">Consenti ripetizioni di uno o più caratteri</label>
    <input type="radio" id="repeat" name="repeat" value="si">
    <label for="repeat">Si</label>
    <input type="radio" id="repeat" name="repeat" value="no">
    <label for="repeat">No</label>
    <br>
    <!-- creo un array (characters[]) che ha per valore i tipi di caratteri selezionati (checked) -->
    <label for="characters">Caratteri ammessi:</label>
    <input type="checkbox" id="numbers" name="characters[]" value="numbers">
    <label for="numbers">Numeri</label>
    <input type="checkbox" id="lower" name="characters[]" value="lower">
    <label for="lower">Lettere minuscole</label>
    <input type="checkbox" id="upper" name="characters[]" value="upper">
    <label for="upper">Lettere maiuscole</label>
    <input type="checkbox" id="symbols" name="characters[]" value="symbols">
    <label for="symbols">Simboli</label>
    <br>    
    <button type="submit">Genera Password</button>
</form>
    
</body>
</html>