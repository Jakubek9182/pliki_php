
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>MOJE PLIKI</h1>

<p>
    <b>Aktualny katalog:</b><br>
    <?php
        echo getcwd();
    ?>
</p>

<h2>ZAWARTOŚĆ KATALOGU</h2>

<table>
    <tr>
        <th>Nazwa</th>
        <th>Typ</th>
        <th>Rozmiar</th>
    </tr>

    <?php
        $katalog = "dokumenty";

        if (file_exists($katalog)) {

            $pliki = scandir($katalog);

            foreach ($pliki as $plik) {

                if ($plik != "." && $plik != "..") {

                    $sciezka = $katalog . "/" . $plik;

                    echo "<tr>";
                    echo "<td>$plik</td>";

                    if (is_file($sciezka)) {
                        echo "<td>PLIK</td>";
                        echo "<td>" . filesize($sciezka) . " B</td>";
                    }

                    if (is_dir($sciezka)) {
                        echo "<td>KATALOG</td>";
                        echo "<td>-</td>";
                    }

                    echo "</tr>";
                }
            }

        } else {
            echo "<tr>";
            echo "<td colspan='3'>Katalog nie istnieje</td>";
            echo "</tr>";
        }
    ?>

</table>

<h2>Utwórz plik</h2>

<form method="post">
    <label>Nazwa pliku:</label>
    <input type="text" name="nazwa">

    <input type="submit" value="Utwórz">
</form>

<?php

if (isset($_POST["nazwa"])) {

    $nazwa = $_POST["nazwa"];

    if ($nazwa != "") {

        $sciezka = "dokumenty/" . $nazwa;

        if (!file_exists($sciezka)) {
            file_put_contents($sciezka, "");
            echo "<p>Plik został utworzony.</p>";
        } else {
            echo "<p>Taki plik już istnieje.</p>";
        }
    }
}

?>

</body>
</html>
