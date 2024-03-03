<?php
session_start();

// Verifica se l'utente è autenticato come admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login_admin.php");
    exit();
}

// Connessione al database
$mysqli = new mysqli("localhost", "username", "password", "database");

// Verifica la connessione al database
if ($mysqli->connect_error) {
    die("Connessione al database fallita: " . $mysqli->connect_error);
}

// Verifica se il modulo di inserimento è stato inviato
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dal modulo
    $dato1 = $_POST['dato1'];
    $dato2 = $_POST['dato2'];

    // Esegui l'istruzione SQL per inserire i dati nella tabella degli utenti
    $query = "INSERT INTO utenti (campo1, campo2) VALUES ('$dato1', '$dato2')";
    if ($mysqli->query($query) === TRUE) {
        echo "Dati inseriti con successo.";
    } else {
        echo "Errore nell'inserimento dei dati: " . $mysqli->error;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area</title>
</head>
<body>
    <h2>Aggiungi dati degli utenti</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="dato1">Dato 1:</label>
        <input type="text" id="dato1" name="dato1" required><br><br>
        <label for="dato2">Dato 2:</label>
        <input type="text" id="dato2" name="dato2" required><br><br>
        <input type="submit" value="Aggiungi">
    </form>
</body>
</html>
