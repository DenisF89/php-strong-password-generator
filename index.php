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


    $length = $_GET['length'] ?? '';
    $repeat = $_GET['repeat'] ?? 'si';
    $selectedCharacters = $_GET['characters'] ?? [];

    $message = 'Inserisci i parametri richiesti per generare la password.';


if (isset($_GET['length']) && $_GET['length'] != ""){

    $result = generatePassword();

    if ($result['success']) {
        $_SESSION['password'] = $result['password'];
        header('Location: result.php');
    } else {
        $message = $result['message'];
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>php-strong-password-generator</title>
</head>
<body>
    <div class="container-fluid wrapper">
        <div class="container">
            <h1 class="title">Strong Password Generator</h1>
            <h2 class="subtitle">Genera una password sicura</h2>

            <div class="alert custom-alert <?php echo isset($result) && !$result['success'] ? 'alert-danger' : 'alert-info'; ?>" role="alert">
                <?php echo $message; ?>
            </div>

            <div class="form-card">
                <form action="" method="GET">
                    <div class="row mb-4 align-items-center">
                        <div class="col-md-7">
                            <label for="length" class="form-label form-label-custom">Lunghezza password:</label>
                        </div>
                        <div class="col-md-3">
                            <input  type="number" class="form-control" id="length" name="length" 
                                    min="8" max="20" value=<?php echo $_GET['length']??""?>
                            >
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-7">
                            <label class="form-label form-label-custom">Consenti ripetizioni di uno o più caratteri:</label>
                        </div>
                        <div class="col-md-5 radio-group">
                            <div class="form-check">
                                <input  type="radio" class="form-check-input" id="repeat_yes" name="repeat" 
                                        value="si" <?php echo ($repeat === 'si') ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="repeat_yes">Si</label>
                            </div>
                            <div class="form-check">
                                <input  type="radio" class="form-check-input" id="repeat_no" name="repeat" 
                                        value="no" <?php echo ($repeat === 'no') ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="repeat_no">No</label>
                            </div>
                        </div>
                    </div>

                    <!-- creo un array (characters[]) che ha per valore i tipi di caratteri selezionati (checked) -->
                    <div class="row mb-5">
                        <div class="col-md-7">
                            <label class="form-label form-label-custom">Caratteri ammessi:</label>
                        </div>
                        <div class="col-md-5 checkbox-group">
                            <div class="form-check">
                                <input  type="checkbox" class="form-check-input" id="lower" name="characters[]" 
                                        value="lower" <?php echo in_array('lower', $selectedCharacters) ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="lower">Lettere</label>
                            </div>
                            <div class="form-check">
                                <input  type="checkbox" class="form-check-input" id="numbers" name="characters[]"
                                        value="numbers" <?php echo in_array('numbers', $selectedCharacters) ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="numbers">Numeri</label>
                            </div>
                            <div class="form-check">
                                <input  type="checkbox" class="form-check-input" id="symbols" name="characters[]"
                                        value="symbols" <?php echo in_array('symbols', $selectedCharacters) ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="symbols">Simboli</label>
                            </div>
                            <div class="form-check">
                                <input  type="checkbox" class="form-check-input" id="upper" name="characters[]"
                                        value="upper" <?php echo in_array('upper', $selectedCharacters) ? 'checked' : ''; ?>
                                >
                                <label class="form-check-label" for="upper">Lettere maiuscole</label>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4 py-2">Invia</button>
                        <a href="index.php" class="btn btn-secondary px-4 py-2">Annulla</a>
                    </div>
                </form>
            </div>
        </div>
    </div>  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




