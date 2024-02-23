<?php
    require_once "dbconnect.php";
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waluty</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="baner1">
        <img src="waluty.png">
    </div>
    <div class="baner2">
        <h1>Kalkulator walut</h1>
    </div>
    <div class="clr">&nbsp;</div>
    <div class="lewy">
        <form method="POST" action="index.php">
            <table>
            <h3>Waluta źródłowa</h3>
                </select>
                    <select name="src" id="src">
                    <option value="EUR">EURO (EUR)</option>
                    <option value="USD">Dolar Amerykański (USD)</option>
                    <option value="PLN">Polski Złoty (PLN)</option>
                </select>
                <input type="text" id=valsrc>
                <h3>Waluta docelowa</h3>
                </select>
                    <select name="des" id="des">
                    <option value="EUR">EURO (EUR)</option>
                    <option value="USD">Dolar Amerykański (USD)</option>
                    <option value="PLN">Polski Złoty (PLN)</option>
                </select>
                <input type="text" id=valdes>
                    <input type="submit">
                <p> Obsługiwane waluty: USD, PLN, EUR</p>

            </table>
        </form>
    </div>
    <div class="prawy">

    </div>


    <script>

    </script>
    <?php
        mysqli_close($dbconn);
    ?>
</body>
</html>