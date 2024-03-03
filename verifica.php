<?php
// Codice per la registrazione dell'utente...
// Dopo che l'utente si è registrato con successo e i dati sono stati inseriti nel database...

// Verifica se l'utente è un amministratore
$isAdmin = false; // Assumiamo che tu abbia un modo per determinare se l'utente è un amministratore
if ($isAdmin) {
    // Se l'utente è un amministratore, reindirizzalo alla sua pagina privata
    header("Location: admin.php");
    exit();
}

// Assicurati che l'utente sia loggato
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Creazione della pagina personalizzata per l'utente
$nomeUtente = $_POST['username']; // Assumendo che il nome utente sia stato fornito durante la registrazione
$emailUtente = $_POST['email']; // Assumendo che l'email sia stata fornita durante la registrazione

// Generazione del contenuto della pagina PHP personalizzata
$phpContent = <<<PHP
<?php include 'header.php'; ?>
<h1>Benvenuto, $nomeUtente</h1>
<p>Email: $emailUtente</p>
<p>Questa è la tua pagina personale.</p>
<?php include 'footer.php'; ?>
PHP;

// Creazione del nome del file per la pagina personalizzata dell'utente
$nomeFile = strtolower(str_replace(' ', '_', $nomeUtente)) . ".php";

// Scrittura del contenuto nella pagina PHP personalizzata dell'utente
file_put_contents($nomeFile, $phpContent);

// Reindirizzamento dell'utente alla propria pagina personale
header("Location: $nomeFile");
exit();
?>
