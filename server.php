<?php
// recupero il contenuto del file JSON
$sting = file_get_contents('data/todo_list.json') ;

// Converte il contenuto in un array associativo
$array = json_decode($sting , true);

// Controllo se è stata inviata una richiesta POST per aggiungere una nuova task
if (isset($_POST['todoItem'])) {
    
    $task = [
        'text' => $_POST['todoItem'],
        'done' => false
    ];

    array_push($array, $task);
    $array_encoded = json_encode($array);
    file_get_contents('data/todo_list.json', $array_encoded);
}

if(isset($_POST['changeItemStatus'])){
    $array[$_POST['updateTaskIndex']]['done'] = !$array[$_POST['changeItemStatus']]['done'];
    $array_encoded = json_encode($array);
    file_put_contents('data/todo_list.json', $array_encoded);
}

if(isset($_POST['deleteItemIndex'])){
    array_splice($array, $_POST['deleteItemIndex'], 1);
    $array_encoded = json_encode($array);
    file_put_contents('data/todo_list.json', $array_encoded);
}


// Imposta l'intestazione della risposta come JSON
header('Content-Type: application/json');

// Restituisce l'array della lista delle task come JSON
echo json_encode($array);
?>