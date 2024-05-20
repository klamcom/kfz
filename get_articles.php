<?php
require "inc/db-connect.php";

$searchTerm = $_GET['searchTerm'] ?? '';
$query = $pdo->prepare("SELECT id, bezeichnung, preis FROM ersatzteil_leistung WHERE bezeichnung LIKE :name LIMIT 10");
$query->execute(['name' => "%" . $searchTerm . "%"]);
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

$options = '<option value="">Bitte wählen</option>';
foreach ($articles as $article) {
    $options .= '<option value="' . htmlspecialchars($article['id']) . '" data-preis="' . htmlspecialchars($article['preis']) . '">' . htmlspecialchars($article['bezeichnung']) . '</option>';
}

echo $options;
?>
