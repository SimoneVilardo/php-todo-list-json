<?php
// Percorso del file JSON
$jsonFilePath = 'data/todo_list.json';

// Recupera il contenuto del file JSON
$jsonContent = file_get_contents($jsonFilePath);

// Converte il contenuto in un array associativo
$todoList = json_decode($jsonContent, true);

// Controllo se è stata inviata una richiesta POST per aggiungere una nuova task
if (isset($_POST['todoItem'])) {
    // Recupera il valore inviato
    $newItem = array(
        'text' => $_POST['todoItem'],
        'done' => false
    );

    // Aggiunge la nuova task all'array
    $todoList[] = $newItem;

    // Converte l'array in formato JSON
    $updatedJsonContent = json_encode($todoList, JSON_PRETTY_PRINT);

    // Salva il contenuto nel file JSON
    file_put_contents($jsonFilePath, $updatedJsonContent);
}

// Imposta l'intestazione della risposta come JSON
header('Content-Type: application/json');

// Restituisce l'array della lista delle task come JSON
echo json_encode($todoList);
?>