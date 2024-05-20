<?php
require "inc/db-connect.php"; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lfdNr'])) {
    $kfzId = $_POST['lfdNr'];

    $stmt = $pdo->prepare("DELETE FROM kfz WHERE lfdNr = :lfdNr");

    $stmt->bindParam(':lfdNr', $kfzId, PDO::PARAM_INT);

    try {
        $stmt->execute();
        header("Location: index3.php"); // Gehe zur KFZ-Listenseite
        exit();
    } catch (PDOException $e) {
        die("Ein Fehler ist aufgetreten: " . $e->getMessage());
    }
} else {
    header("Location: index3.php"); // Gehe zurück zum KFZ-Formular
    exit();
}
?>
