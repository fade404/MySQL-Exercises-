<?php

$conn = new mysqli('localhost', 'root', '', 'cinemas_db');
if ($conn->connect_error) {
    die('Przepraszamy, pracujemy nad bledem.<br>' . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['submit'])) {

        switch ($_POST['submit']) {
            case "cinema":
                if (!empty($_POST['name']) && !empty($_POST['address'])) {
                    $kinoName = $conn->escape_string(trim($_POST['name']));
                    $kinoAddr = $conn->escape_string(trim($_POST['address']));

                    $formCin = "INSERT INTO kino(name, address)" . " VALUES('$kinoName', '$kinoAddr')";
                    $cinema = $conn->query($formCin);
                    if ($cinema === true) {
                        echo ('Ok mamy nowe kino');
                    } else {
                        echo 'Nie dziala :( Blad: ' . $conn->error;
                    }
                } else {
                    echo 'Wprowadz poprawne dane';
                }

                break;
            case "movie":
                if (!empty($_POST['name']) && !empty($_POST['desc']) && $_POST['rating'] >= 0 && $_POST['rating'] <= 10) {
                    $movieName = $conn->escape_string(trim($_POST['name']));
                    $movieDesc = $conn->escape_string(trim($_POST['desc']));
                    $movieRating = $conn->escape_string(trim($_POST['rating']));

                    $formMov = "INSERT INTO film(name, opis, rating)" . " VALUES('$movieName', '$movieDesc', $movieRating)";
                    $movie = $conn->query($formMov);
                    if ($movie === true) {
                        echo ('Ok mamy nowy film');
                    } else {
                        echo 'Nie dziala :( Blad: ' . $conn->error;
                    }
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "ticket":
                if (!empty($_POST['quantity']) && $_POST['price'] > 0) {

                    $ticketQuantity = $conn->escape_string(trim($_POST['quantity']));
                    $ticketPrice = $conn->escape_string(trim($_POST['price']));

                    $formTicket = "INSERT INTO bilet(ilosc, cena)" . " VALUES('$ticketQuantity', '$ticketPrice')";
                    $ticket = $conn->query($formTicket);
                    if ($ticket === true) {
                        echo ('Ok mamy nowy bilet');
                    } else {
                        echo 'Nie dziala :( Blad: ' . $conn->error;
                    }
                } else {
                    echo 'Wprowadz poprawne dane';
                }
                break;
            case "payment":
                if (!empty($_POST['payment_date'])) {

                    $payType = $conn->escape_string(trim($_POST['payment_type']));
                    $payDate = $conn->escape_string(trim($_POST['payment_date']));
                    $bilet_id = $conn->escape_string(trim($_POST['bilet_id']));
                    
                    $formPayment = "INSERT INTO platnosc(typ, data, bilet_id)" . " VALUES('$payType', '$payDate', '$bilet_id')";
                    $payment = $conn->query($formPayment);
                    if ($payment === true) {
                        echo ('Ok mamy nowa platnosc');
                    } else {
                        echo 'Podaj bilet i date ' . $conn->error;
                    }
                } else {
                    echo 'Wprowadz poprawną datę';
                }
                break;
        }
    }
}





$conn->close();
$conn = NULL;
?>

<h4>Dodaj kino</h4>
<div>
    <form class="cinema_form" method="post" action="">
        
        <label>Nazwa</label><br>
        <input name="name" type="text" maxlength="255" value=""/><br>
        <label>Adres</label><br>
        <input name="address" type="text" maxlength="255" value=""/><br>
        <button type="submit" name="submit" value="cinema">Wyslij</button>
    </form>
</div>
<br>
<h4>Dodaj film</h4>
<div>
    <form class="movie_form" method="post" action="">
        <label>Nazwa</label><br>
        <input name="name" type="text" maxlength="255" value=""/><br>
        <label>Opis</label><br>
        <input name="desc" type="text" maxlength="255" value=""/><br>
        <label>Rating</label><br>
        <input name="rating" type="number" min="0" max="10"/><br>
        <button type="submit" name="submit" value="movie">Wyslij</button>
    </form>
</div>

<br>
<h4>Dodaj bilet</h4>

<div>
    <form class="ticket_form" method="post" action="">
        <label>Ilosc</label><br>
        <input name="quantity" type="number" min="0"/><br>
        <label>Cena</label><br>
        <input name="price" type="number" min="0" step="0.01"/><br>
        <button type="submit" name="submit" value="ticket">Wyslij</button>
    </form>
</div>
<br>
<h4>Dodaj płatność</h4>

<div>
    <form class="payment_form" method="post" action="">
        <label>Typ platnosci</label><br>
        <select name="payment_type">
            <option value="transfer">Przelew</option>
            <option value="cash">Gotowka</option>
            <option value="card">Karta</option>
        </select><br>
        <label>Id biletu</label><br>
        <input type="number" name="bilet_id"><br>
        <label>Data</label><br>
        <input type="date" name="payment_date"><br>
        <button type="submit" name="submit" value="payment">Wyslij</button>
    </form>
</div>
