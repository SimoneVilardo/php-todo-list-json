<?php
    // Leggi il contenuto del file JSON
    $string = file_get_contents('data/todo_list.json');

    // Decodifica il contenuto JSON in un array associativo
    $array = json_decode($string, true);

    // Controlla se è stato inviato un nuovo elemento tramite POST
    if(isset($_POST['todoItem'])){
        // Aggiungi il nuovo elemento all'array
        array_push($array, $_POST['todoItem']);

        // Codifica l'array aggiornato in formato JSON
        $array_encoded = json_encode($array);

        // Scrivi il contenuto JSON nel file
        file_put_contents('data/todo_list.json', $array_encoded);
    }

    // Imposta l'intestazione della risposta come JSON
    header('Content-Type: application/json');

    // Restituisci l'array come JSON
    echo json_encode($array);
?>