<?php
require "inc/db-connect.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $kundenNr = $_POST['id'];

    $stmt = $pdo->prepare("DELETE FROM kunden WHERE kundenNr = :kundenNr");

    $stmt->bindParam(':kundenNr', $kundenNr, PDO::PARAM_INT);

    try {
        $stmt->execute();
        header("Location: index2.php"); 
        exit();
    } catch (PDOException $e) {
        die("Ein Fehler ist aufgetreten: " . $e->getMessage());
    }
} else {
    header("Location: index.php"); 
    exit();
}
?>
