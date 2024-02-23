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
    <p id="usd-to-pln">Ładowanie kursu...</p>
    </div>

<script>
    document.addEventListener("DOMContentLoaded", function()
    {
        const form = document.querySelector('form'); // Pobieramy formularz
        const kursParagraph = document.getElementById('usd-to-pln'); // Pobieramy paragraf, gdzie wyświetlimy kurs

        form.addEventListener('submit', function(event)
        {
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
    require_once "dbconnect.php"; // Połączenie z bazą danych

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Odczytaj dane z formularza
        $srcCurrency = mysqli_real_escape_string($dbconn, $_POST['src']);
        $desCurrency = mysqli_real_escape_string($dbconn, $_POST['des']);
        $amount = mysqli_real_escape_string($dbconn, $_POST['kwota']);

        // Pobierz aktualny kurs z wybranego źródła (np. API)
        $api_url = 'https://api.exchangerate-api.com/v4/latest/' . $srcCurrency;
        $exchange_rate_data = json_decode(file_get_contents($api_url), true);
        $exchange_rate = $exchange_rate_data['rates'][$desCurrency];

        // Wylicz kwotę przeliczoną
        $result = $amount * $exchange_rate;

        // Przygotowanie zapytania SQL do wstawienia danych do bazy
        $sql = "INSERT INTO przeliczenia (waluta_zrodlowa, waluta_docelowa, kwota_zrodlowa, kwota_docelowa, kurs) VALUES (?, ?, ?, ?, ?)";

        // Wykonanie zapytania przy użyciu prepared statements
        if($stmt = mysqli_prepare($dbconn, $sql)){
            // Przypisanie parametrów do prepared statements
            mysqli_stmt_bind_param($stmt, "ssdds", $srcCurrency, $desCurrency, $amount, $result, $exchange_rate);

            // Wykonanie prepared statements
            if(mysqli_stmt_execute($stmt)) {
                echo "Dane zostały pomyślnie zapisane.";
            } else {
                echo "Coś poszło nie tak. Spróbuj ponownie później.";
            }
        }

        // Zamknięcie statement
        mysqli_stmt_close($stmt);

        // Zamknięcie połączenia z bazą danych
        mysqli_close($dbconn);
    }
?>
</body>
</html>