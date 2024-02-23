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
                <input type="text" name="kwota" >
                <h3>Waluta docelowa</h3>
                </select>
                    <select name="des" id="des">
                    <option value="EUR">EURO (EUR)</option>
                    <option value="USD">Dolar Amerykański (USD)</option>
                    <option value="PLN">Polski Złoty (PLN)</option>
                </select>
                    <input type="submit">
                <p> Obsługiwane waluty: USD, PLN, EUR</p>

            </table>
        </form>
    </div>
    <div class="prawy">
    <h2>Aktualny kurs:</h2>
    <p id="usd-to-pln">Wybierz walutę źródłową, docelową oraz podaj wartość</p>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector('form'); // Pobieramy formularz
        const kursParagraph = document.getElementById('usd-to-pln'); // Pobieramy paragraf, gdzie wyświetlimy kurs

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Zapobiegamy domyślnej akcji formularza

            const srcCurrency = document.getElementById('src').value; // Pobieramy walutę źródłową
            const desCurrency = document.getElementById('des').value; // Pobieramy walutę docelową
            const amount = parseFloat(document.querySelector('input[name="kwota"]').value); // Pobieramy wartość waluty wejściowej

            // Pobieramy kurs wybranej waluty
            fetch('https://api.exchangerate-api.com/v4/latest/' + srcCurrency)
                .then(response => response.json())
                .then(data =>
                {
                    const exchangeRate = data.rates[desCurrency]; // Pobieramy kurs dla wybranej waluty docelowej

                    // Wyliczamy wartość waluty docelowej
                    const result = amount * exchangeRate;

                    kursParagraph.textContent = `${amount} ${srcCurrency} kosztuje ${result.toFixed(2)} ${desCurrency} po kursie ${exchangeRate} za 1 ${srcCurrency}`;
                })
                .catch(error => {
                    console.log("Wystąpił błąd podczas pobierania kursu:", error);
                });
        });
    });
</script>

<?php
    mysqli_close($dbconn);
?>
</body>
</html>