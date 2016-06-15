<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Mini portal kinowy</title>
    </head>
    <body>

        <?php
        ?>
        <h4>Dodaj kino, płatność, bilet, film</h4>
        <a href="add.php" target = "_blank">
            <button type="submit">Dodaj</button>
        </a>

        <h4>Usuń kino, płatność, bilet, film</h4>
        <a href="show.php" target = "_blank">
            <button type="submit">Usuń</button>
        </a>

        <div>
            <form method="post" action="./search.php">
                <br>
                <label>Szukaj kina</label><br>
                <input name="search_cinema" type="text" maxlength="255" value=""/><br>
                <button type="submit" name="submit" value="cinema">Wyślij</button>
            </form>
        </div>
        <br>
        <div>
            <form method="post" action="./search.php">
                <label>Szukaj filmu wg tytułu</label><br>
                <input name="search_film_name" type="text" maxlength="255" placeholder="Wpisz tytuł"/><br>
                <label>Szukaj filmu wg ratingu</label><br>
                <input name="search_film_rating" type="number" min="1" max="10" placeholder="Rating"/><br>
                <button type="submit" name="submit" value="film" >Wyślij</button>
            </form>
        </div>
        <br>
        <div>
            <form method="post" action="./search.php">
                <label>Szukaj platności wg daty</label><br>
                <select name="submit">
                    <option value="mlodsze_niz">Młodsze niż</option>
                    <option value="starsze_niz">Starsze niż</option>
                    <option value="wybrana_data">Wybrana data</option>
                </select><br>
                <label>Data</label><br>
                <input type="date" name="payment_date"><br>
                <button type="submit">Szukaj</button><br><br>
            </form>
            <form method="post" action="./search.php">
                <label>Szukaj platności z zakresu dat</label><br>
                <select name="submit">
                    <option value="od_do">Z zakresu dat</option>
                </select><br>
                <input type="date" name="payment_date_od">
                <input type="date" name="payment_date_do">
                <button type="submit">Wyslij</button>
            </form>
        </div>

    </body>
</html>
