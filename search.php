<?php

$conn = new mysqli('localhost', 'root', '', 'cinemas_db');
if ($conn->connect_error) {
    die('Przepraszamy za błąd.');
}

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

                echo '<td>' . $row[$field] . "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo 'Brak danych!';
    }
    echo '<br>';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {
        switch ($_POST['submit']) {
            case "cinema":
                if (!empty($_POST['search_cinema'])) {
                    $kinoName = $conn->escape_string(trim($_POST['search_cinema']));
                    showInfoInTable('kino', "name LIKE '%$kinoName%'", ['id', 'name', 'address']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "film":
                if (!empty($_POST['search_film_name'])) {
                    $filmName = $conn->escape_string(trim($_POST['search_film_name']));

                    showInfoInTable('film', "name LIKE '%$filmName%'", ['id', 'name', 'opis', 'rating']);
                } elseif ($_POST['search_film_rating'] > 0) {
                    $filmRating = $conn->escape_string(trim($_POST['search_film_rating']));
                    showInfoInTable('film', "rating = $filmRating", ['id', 'name', 'opis', 'rating']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "mlodsze_niz":
                if (!empty($_POST['payment_date'])) {
                    $paymentDate = $conn->escape_string(trim($_POST['payment_date']));
                    showInfoInTable('platnosc', "data<'$paymentDate'", ['id', 'typ', 'data']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "starsze_niz":
                if (!empty($_POST['payment_date'])) {
                    $paymentDate = $conn->escape_string(trim($_POST['payment_date']));
                    showInfoInTable('platnosc', "data>'$paymentDate'", ['id', 'typ', 'data']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "wybrana_data":
                if (!empty($_POST['payment_date'])) {
                    $paymentDate = $conn->escape_string(trim($_POST['payment_date']));
                    showInfoInTable('platnosc', "data='$paymentDate'", ['id', 'typ', 'data']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "od_do":
                if (!empty($_POST['payment_date_od']) && !empty($_POST['payment_date_do'])) {
                    $paymentDateOd = $conn->escape_string(trim($_POST['payment_date_od']));
                    $paymentDateDo = $conn->escape_string(trim($_POST['payment_date_do']));
                    
                    showInfoInTable('platnosc', "data>'$paymentDateOd' AND data<'$paymentDateDo'", ['id', 'typ', 'data']);
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
        }
    }
}

$conn->close();
$conn = null;
