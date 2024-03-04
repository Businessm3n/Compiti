<?php
// Verifica se l'utente è loggato e ha il ruolo di admin
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("location: login.php");
    exit;
}

// Includi il file di configurazione del database
include 'config.php';

// Esegui una query SQL per ottenere gli utenti con ruolo "utente" dal database
$sql = "SELECT id, user FROM lavori1 WHERE role = 'user'";
$result = mysqli_query($conn, $sql);

// Gestisci il form di selezione dell'utente
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["select_user"])) {
    $selected_user_id = $_POST["user_id"];
    
    // Esegui una query SQL per ottenere i dati dell'utente selezionato
    $sql_data = "SELECT nome, nome_progetto, numero_progetto, soldi_pagati, soldi_pattuiti, debito FROM lavori1 WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql_data)) {
        mysqli_stmt_bind_param($stmt, "i", $selected_user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $nome_progetto, $numero_progetto, $soldi_pagati, $soldi_pattuiti, $debito);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    }
}
?>

