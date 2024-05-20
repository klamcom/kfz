<?php
// Include the database connection file
require 'inc/db-connect.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract and validate form data
    // Use real_escape_string() or prepared statements to prevent SQL Injection
    $kunde = $_POST['kunde'];
    $kennzeichen = $_POST['kennzeichen'];
    $marke = $_POST['marke'];
    $type = $_POST['type'];
    $baujahr = $_POST['baujahr'];
    $kmStand = $_POST['kmStand'];
    $kw = $_POST['kw'];
    $benzinDiesel = $_POST['BenzinDiesel'];
    $tueren = $_POST['tueren'];
    $kombi = $_POST['kombi'];
    $zulassung = $_POST['zulassung'];
    $erstzulassung = $_POST['erstzulassung'];
    $fahrgestellnummer = $_POST['fahrgestellnummer'];
    $motornummer = $_POST['motornummer'];
    $hubraum = $_POST['hubraum'];
    $fin = $_POST['fin'];

    // Prepare the SQL statement to insert data
    $stmt = $pdo->prepare("INSERT INTO kfz (fkKundennummer, kennzeichen, marke, type, baujahr, kmStand, kw, BenzinDiesel, tueren, kombi, zulassung, erstzulassung, fahrgestellnummer, motornummer, hubraum, fin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    // Bind parameters to the prepared statement
    $stmt->bindParam(1, $kunde);
    $stmt->bindParam(2, $kennzeichen);
    $stmt->bindParam(3, $marke);
    $stmt->bindParam(4, $type);
    $stmt->bindParam(5, $baujahr);
    $stmt->bindParam(6, $kmStand);
    $stmt->bindParam(7, $kw);
    $stmt->bindParam(8, $benzinDiesel);
    $stmt->bindParam(9, $tueren);
    $stmt->bindParam(10, $kombi);
    $stmt->bindParam(11, $zulassung);
    $stmt->bindParam(12, $erstzulassung);
    $stmt->bindParam(13, $fahrgestellnummer);
    $stmt->bindParam(14, $motornummer);
    $stmt->bindParam(15, $hubraum);
    $stmt->bindParam(16, $fin);

    // Execute the prepared statement
    $stmt->execute();

    // Redirect to the main page or display a success message
    // You should implement error checking in a real application
    header("Location: index3.php");
    exit();
} else {
    // If not POST request, redirect to the form or display an error
    header("Location: index3.php");
    exit();
}
?>
