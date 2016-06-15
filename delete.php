<?php

$conn = new mysqli('localhost', 'root', '', 'cinemas_db');
if ($conn->connect_error) {
    die('Przepraszamy, pracujemy nad bledem.<br>' . $conn->connect_error);
}

if (!isset($_GET['Id'])) {
    echo 'Id nie jest podany';
} elseif (!isset($_GET['table'])) {
    echo 'Tabela nie jest podana';
} else {
    $table = $conn->escape_string($_GET['table']);
    $id = $conn->escape_string($_GET['Id']);

    if (in_array($_GET['table'], ['film', 'bilet', 'platnosc', 'kino'])) {

        $delCin = "DELETE FROM $table WHERE id=$id";
        
        $result = $conn->query($delCin);
        
        if ($result === true) {
            echo 'usuniete<br>';
        } else {
            echo 'Blad';
        }
    }
}


$conn->close();
$conn = NULL;
