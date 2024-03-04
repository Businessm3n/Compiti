<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Your Profile</h2>
    <table>
        <thead>
            <tr>
                <th>Field</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Includi il file di configurazione del database
            include 'config.php';

            // Recupera i dati dell'utente corrente
            // Supponiamo che l'ID dell'utente sia memorizzato nella sessione
            $userId = $_SESSION["id"];
            $sql = "SELECT * FROM utenti WHERE id = $userId";
            $result = mysqli_query($conn, $sql);

            // Verifica se ci sono risultati
            if (mysqli_num_rows($result) > 0) {
                // Visualizza i dati dell'utente in una tabella
                while ($row = mysqli_fetch_assoc($result)) {
                    foreach ($row as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . ucfirst($key) . "</td>"; // Mostra il nome del campo (con la prima lettera maiuscola)
                        echo "<td>" . $value . "</td>"; // Mostra il valore del campo
                        echo "</tr>";
                    }
                }
            } else {
                echo "<tr><td colspan='2'>Nessun dato trovato.</td></tr>";
            }

            // Chiudi la connessione
            mysqli_close($conn);
            ?>
        </tbody>
    </table>
</body>
</html>
