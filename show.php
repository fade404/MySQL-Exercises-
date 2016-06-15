<?php

$conn = new mysqli('localhost', 'root', '', 'cinemas_db');
if ($conn->connect_error) {
    die('Przepraszamy za błąd.');
}

/**
 * Funkcja do wyświetlania w tabeli HTML danych z wybranej tabeli MySQL, wybranym zapytaniem WHERE, wybranych pól.
 * @param string $dbTable Nazwa tabeli MySQL
 * @param string $whereQuery Zapytanie WHERE
 * @param array $fieldsToShow Tablica z nazwami pól do wyświetlenia
 */
function showInfoInTable($dbTable, $whereQuery, $fieldsToShow) {
    global $conn;

    //Tworzymy z tablicy listę jak w SQL, np. ['a', 'b', 'c'] => 'a, b, c'
    $fieldsInSql = implode(', ', $fieldsToShow);
    $sql = "SELECT $fieldsInSql FROM $dbTable WHERE $whereQuery";

    echo '<pre>' . $sql . '</pre>';

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border=1px>";

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            //Dla każdego pola, które nas interesuje...
            foreach ($fieldsToShow as $field) {
                //...wyświetl z rzędu pole o tej nazwie
                $idG = $conn->escape_string($row['id']);
                echo '<td>' . $row[$field] . "<a href='delete.php?Id=$idG&table=$dbTable' target='_blank'> Usuń </a></td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo 'Brak filmów!';
    }
    echo '<br>';
}

showInfoInTable('film', '1', ['id', 'name', 'opis', 'rating']);
showInfoInTable('bilet', '1', ['id', 'cena', 'ilosc']);
showInfoInTable('kino', '1', ['id', 'address']);
showInfoInTable('platnosc', '1', ['id', 'typ', 'data']);


$conn->close();
$conn = null;
