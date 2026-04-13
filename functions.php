<?php

function generatePassword() {
    $length = $_GET['length'] ?? 8; 
    $repeat = $_GET['repeat'] ?? 'si';
    $selected = $_GET['characters'] ?? [];                      //array che contiene i tipi di caratteri selezionati dall'utente (numeri, lettere minuscole, lettere maiuscole, simboli)
                               
    $map = [                                                    //mappa che associa ogni tipo di carattere al relativo set di caratteri. E' un array associativo chiave(tipo)=>valore(array di caratteri).
        'numbers' => range('0', '9'),                           // range() crea un array con i valori compresi tra quelli specificati.
        'lower'   => range('a', 'z'),
        'upper'   => range('A', 'Z'),
        'symbols' => str_split('!@#$%^&*?')                     // str_split() divide una stringa in un array di caratteri.
    ];


//VALIDAZIONE DEI PARAMETRI

    //VARIABILI PER LA VALIDAZIONE
    $errors = [];
    $allowedCharacters = ['numbers', 'lower', 'upper', 'symbols'];
    $length = filter_var($length, FILTER_VALIDATE_INT);             //verifica se $length è un numero intero valido. restituisce il numero o FALSE

    //VALIDAZIONE LUNGHEZZA PASSWORD
    if ($length === false || $length < 8 || $length > 20) {
        $errors[] = "La lunghezza deve essere un numero intero compreso tra 8 e 20.";
    }

    //VALIDAZIONE RADIO BUTTON
    if ($repeat !== 'si' && $repeat !== 'no') {
        $errors[] = "Il valore per le ripetizioni deve essere si/no.";
    }

    //VALIDAZIONE CHECKBOX DEI TIPI DI CARATTERI
    if (!is_array($selected) || empty($selected)) {                 //verifica se $selected è un array e se non è vuoto
        $errors[] = 'Seleziona almeno un gruppo di caratteri.';
    } else {
        $invalid = array_diff($selected, $allowedCharacters);       //verifica se ci sono valori non validi in $selected confrontandolo con $allowedCharacters. 
        if (!empty($invalid)) {                                     //restituisce un array con i valori non validi
            $errors[] = 'Uno o più valori selezionati non sono validi.';
        }
    }

    if ($errors) {  // se ci sono errori, restituisco un array con success=false e il messaggio di errore
        return [
            'success' => false,
            'message' => implode('<br>', $errors)
        ];
    }

    //CREAZIONE DELL'ARRAY DEI CARATTERI IN BASE ALLE SCELTE DELL'UTENTE
    $characters = [];

    foreach ($selected as $type) {                              //per ogni tipo di carattere nell'array $selected
        $characters = array_merge($characters, $map[$type]);    //prendo il set di caratteri corrispondente dalla mappa e lo unisco all'array $characters con array_merge().
    }

    //  versione moderna >>> $characters = array_merge(...array_map(fn($type) => $map[$type] ?? [], $selected));

    //CONTROLLO RIPETIZIONI
    if ($repeat === 'no' && count($characters) < $length) {     //se non sono ammesse ripetizioni e il numero totale di caratteri è inferiore alla lunghezza richiesta
            $errors[] = 'Non è possibile generare una password senza ripetizioni con le opzioni selezionate.';
        }

    if ($errors) {
        return [
            'success' => false,
            'message' => implode('<br>', $errors)
        ];
    }

    //GENERAZIONE DELLA PASSWORD
    $password = [];
    for ($i = 0; $i < $length; $i++) {
        
            $index = random_int(0, count($characters)-1);       //indice casuale dell'array
            $password[] = $characters[$index];                  //prendo il carattere corrispondente all'indice e lo aggiungo alla password
            
            if ($repeat === 'no') {                             //se non sono ammesse ripetizioni
                array_splice($characters, $index, 1);           //rimuovo il carattere dall'array $characters con array_splice()
            }
    }
    shuffle($password);                                         //mescola i caratteri
    return [                                                    //restituisco un array con success=true e la password generata
        'success' => true,
        'password' => implode('', $password)
    ];
}

?>