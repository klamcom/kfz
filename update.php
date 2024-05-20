<?php
require "inc/db-connect.php";

if (!empty($_POST)) {

    $kundenNr = isset($_POST['kundenNr']) ? (int) $_POST['kundenNr'] : 0;

    $anrede = isset($_POST['anrede']) ? (int) $_POST['anrede'] : '';
    $titelvor = isset($_POST['titelvor']) ? (string) $_POST['titelvor'] : '';
    $nachname = isset($_POST['nachname']) ? (string) $_POST['nachname'] : '';
    $vorname = isset($_POST['vorname']) ? (string) $_POST['vorname'] : '';
    $titelnach = isset($_POST['titelnach']) ? (string) $_POST['titelnach'] : '';
    $firma = isset($_POST['firma']) ? (string) $_POST['firma'] : '';
    $strasse = isset($_POST['strasse']) ? (string) $_POST['strasse'] : '';
    $plz = isset($_POST['plz']) ? (string) $_POST['plz'] : '';
    $ort = isset($_POST['ort']) ? (string) $_POST['ort'] : '';
    $telefon = isset($_POST['telefon']) ? (string) $_POST['telefon'] : '';
    $telefon2 = isset($_POST['telefon2']) ? (string) $_POST['telefon2'] : '';
    $mail = isset($_POST['mail']) ? (string) $_POST['mail'] : '';
    $kundeseit = isset($_POST['kundeseit']) ? (string) $_POST['kundeseit'] : '';
    $fax = isset($_POST['fax']) ? (string) $_POST['fax'] : '';
    $kommentar = isset($_POST['kommentar']) ? (string) $_POST['kommentar'] : '';

    $sql = "UPDATE kunden SET fkAnrede = :fkanrede, titelvor = :titelvor, nachname = :nachname, vorname = :vorname, 
            titelnach = :titelnach, firma = :firma, strasse = :strasse, plz = :plz, ort = :ort, telefon = :telefon, 
            telefon2 = :telefon2, mail = :mail, kundeseit = :kundeseit, fax = :fax, kommentar = :kommentar 
            WHERE kundenNr = :kundenNr";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue('kundenNr', $kundenNr);
    $stmt->bindValue('fkanrede', $anrede);
    $stmt->bindValue('titelvor', $titelvor);
    $stmt->bindValue('nachname', $nachname);
    $stmt->bindValue('vorname', $vorname);
    $stmt->bindValue('titelnach', $titelnach);
    $stmt->bindValue('firma', $firma);
    $stmt->bindValue('strasse', $strasse);
    $stmt->bindValue('plz', $plz);
    $stmt->bindValue('ort', $ort);
    $stmt->bindValue('telefon', $telefon);
    $stmt->bindValue('telefon2', $telefon2);
    $stmt->bindValue('mail', $mail);
    $stmt->bindValue('kundeseit', $kundeseit);
    $stmt->bindValue('fax', $fax);
    $stmt->bindValue('kommentar', $kommentar);

    $stmt->execute();

    header("Location: " . $_SERVER['HTTP_REFERER']);
}
?>
