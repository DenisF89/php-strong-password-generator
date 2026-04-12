<!-- Milestone 1
Creare un form che invii in GET la lunghezza desiderata della password. 
Una nostra funzione utilizzerà questo dato per generare una password casuale 
(composta da lettere minuscole, maiuscole, numeri e/o simboli) della lunghezza specificata, da restituire all’utente.
Scirivamo tutta la logica ed il layout in un unico file index.php -->


<?php

function generatePassword() {
    $length = $_GET['length'] ?? 8; 
    
    $numbers = range('0', '9');                 // range() crea un array con i valori compresi tra quelli specificati.
    $lower   = range('a', 'z');
    $upper   = range('A', 'Z');
    $symbols = str_split('!@#$%^&*?');          // str_split() divide una stringa in un array di caratteri.

    $characters = array_merge($numbers, $lower, $upper, $symbols);      //array_merge unisce più array in uno solo. 

    $password = [];
    for ($i = 0; $i < $length; $i++) {
        $password[] = $characters[random_int(0, count($characters)-1)]; //prendo un carattere casuale dall'array. 
    }
    shuffle($password);                 // mescola i caratteri
    return implode('', $password);      // converte l'array in stringa
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
        <button type="submit">Genera Password</button>
</form>

<?php if (isset($_GET['length']) && $_GET['length'] != ""){
   echo "<p>Password generata: ". generatePassword() ."</p>";
   }
?>
    
</body>
</html>