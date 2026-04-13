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

    $characters = [];

    foreach ($selected as $type) {                              //per ogni tipo di carattere nell'array $selected
        $characters = array_merge($characters, $map[$type]);    //prendo il set di caratteri corrispondente dalla mappa e lo unisco all'array $characters con array_merge().
    }

    $password = [];
    for ($i = 0; $i < $length; $i++) {
        
            $index = random_int(0, count($characters)-1);       //indice casuale dell'array
            $password[] = $characters[$index];                  //prendo il carattere corrispondente all'indice e lo aggiungo alla password
            
            if ($repeat === 'no') {                             //se non sono ammesse ripetizioni
                array_splice($characters, $index, 1);           //rimuovo il carattere dall'array $characters con array_splice()
            }
    }
    shuffle($password);                                         //mescola i caratteri
    return implode('', $password);                              //converte l'array in stringa
}

?>