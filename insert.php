<?php
require "inc/db-connect.php";

if (!empty($_POST)) {

    $anrede = '';
    if (isset($_POST['anrede'])) {
        $anrede = (int) $_POST['anrede'];
    }

    $titelvor = '';
    if (isset($_POST['titelvor'])) {
        $titelvor = (string) $_POST['titelvor'];
    }

    $nachname = '';     
    if (isset($_POST['nachname'])) {
        $nachname = (string) $_POST['nachname'];
    }

    $vorname = '';
    if (isset($_POST['vorname'])) {
        $vorname = (string) $_POST['vorname'];
    }

    $titelnach = '';
    if (isset($_POST['titelnach'])) {
        $titelnach = (string) $_POST['titelnach'];
    }

    $firma = '';
    if (isset($_POST['firma'])) {
        $firma = (string) $_POST['firma'];
    }

    $strasse = '';  
    if (isset($_POST['strasse'])) {
        $strasse = (string) $_POST['strasse'];
    }

    $plz = '';
    if (isset($_POST['plz'])) {
        $plz = (string) $_POST['plz'];
    }

    $ort = '';
    if (isset($_POST['ort'])) {
        $ort = (string) $_POST['ort'];
    }

    $telefon = '';
    if (isset($_POST['telefon'])) {
        $telefon = (string) $_POST['telefon'];
    }

    $telefon2 = '';
    if (isset($_POST['telefon2'])) {
        $telefon2 = (string) $_POST['telefon2'];
    }

    $mail = '';
    if (isset($_POST['mail'])) {
        $mail = (string) $_POST['mail'];
    }

    $kundeseit = '';
    if (isset($_POST['kundeseit'])) {
        $kundeseit = (string) $_POST['kundeseit'];
    }

    $fax = '';
    if (isset($_POST['fax'])) {
        $fax = (string) $_POST['fax'];
    }

    $kommentar = '';
    if (isset($_POST['kommentar'])) {
        $kommentar = (string) $_POST['kommentar'];
    }


    if (!empty($anrede) && !empty($nachname) && !empty($vorname) && !empty($strasse) && !empty($plz) && !empty($ort) && !empty($telefon) && !empty($mail) && !empty($kundeseit)) {
        
            $stmt = $pdo->prepare('INSERT INTO kunden (fkAnrede, titelvor, nachname, vorname, titelnach, firma, strasse, plz, ort,  telefon, telefon2, mail, kundeseit, fax, kommentar) 
            VALUES (:fkanrede, :titelvor, :nachname, :vorname, :titelnach, :firma, :strasse, :plz, :ort, :telefon, :telefon2, :mail, :kundeseit, :fax, :kommentar)');
    
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

    
        }
      
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
    ?>

