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