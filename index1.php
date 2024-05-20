<?php require "inc/db-connect.php"; ?>


<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modal Formular Beispiel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $stmt = $pdo->prepare('SELECT * FROM kunden left join anrede on kunden.fkAnrede = anrede.id');
        $stmt->execute();  

        $stmt_anrede = $pdo->prepare("SELECT * FROM anrede");
        $stmt_anrede->execute();
        $anreden = $stmt_anrede->fetchAll(PDO::FETCH_ASSOC);

    ?>
        
    <div class="container mt-5">
        <h2>Kundendaten</h2>
    </div>
    <div class="container-fluid mt-5 table-responsive">
        <table class="table table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Kdnr</th>
                    <th scope="col">Anrede</th>
                    <th scope="col">Titel vor</th>
                    <th scope="col">Nachname</th>
                    <th scope="col">Vorname</th>
                    <th scope="col">Titel nach</th>
                    <th scope="col">Firma</th>
                    <th scope="col">Straße</th>
                    <th scope="col">PLZ</th>
                    <th scope="col">Ort</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Telefon2</th>
                    <th scope="col">E-Mail</th>
                    <th scope="col">Kunde seit</th>
                    <th scope="col">Fax</th>
                    <th scope="col">Kommentar</th>
                    <th scope="col">bearbeiten</th>
                    <th scope="col">löschen</th>
                    <th scope="col">Rechnung</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo $row['kundenNr']; ?></td>
                        <td><?php echo $row['anrede']; ?></td>
                        <td><?php echo $row['titelvor']; ?></td>
                        <td><?php echo $row['nachname']; ?></td>
                        <td><?php echo $row['vorname']; ?></td>
                        <td><?php echo $row['titelnach']; ?></td>
                        <td><?php echo $row['firma']; ?></td>
                        <td><?php echo $row['strasse']; ?></td>
                        <td><?php echo $row['plz']; ?></td>
                        <td><?php echo $row['ort']; ?></td>
                        <td><?php echo $row['telefon']; ?></td>
                        <td><?php echo $row['telefon2']; ?></td>
                        <td><?php echo $row['mail']; ?></td>
                        <td><?php echo $row['kundeseit']; ?></td>
                        <td><?php echo $row['fax']; ?></td>
                        <td><?php echo $row['kommentar']; ?></td>
                        <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateData(
                              <?php echo $row['kundenNr']; ?>,
                              '<?php echo $row['id']; ?>',
                              '<?php echo $row['titelvor']; ?>',
                              '<?php echo $row['nachname']; ?>',
                              '<?php echo $row['vorname']; ?>',
                              '<?php echo $row['titelnach']; ?>',
                              '<?php echo $row['firma']; ?>',
                              '<?php echo $row['strasse']; ?>',
                              '<?php echo $row['plz']; ?>',
                              '<?php echo $row['ort']; ?>',
                              '<?php echo $row['telefon']; ?>',
                              '<?php echo $row['telefon2']; ?>',
                              '<?php echo $row['mail']; ?>',
                              '<?php echo $row['kundeseit']; ?>',
                              '<?php echo $row['fax']; ?>',
                              '<?php echo $row['kommentar']; ?>')">Bearbeiten</button></td>
                        <td><button type="button" class="btn btn-danger btn-sm deleteButton" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $row['kundenNr']; ?>">Löschen</button>
                        </td>
                        <td><a href='rechnung.php?kundennr=<?php echo $row['kundenNr']; ?>' class='btn btn-secondary btn-sm'>Neue Rechnung</a></td>
                        <td></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <button type="button" class="btn btn-primary mt-5" data-bs-toggle="modal" data-bs-target="#beispielModal">
        Eintrag hinzufügen
        </button>
    </div>


<!-- Modal -->
<div class="modal fade" id="beispielModal" tabindex="-1" aria-labelledby="beispielModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="beispielModalLabel">Neuen Kunden hinzufügen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <form action="insert.php" method="post">
        <div class="modal-body">
          <div class="form-group">
              <label for="anrede" class="form-label">Anrede</label>
              <select class="form-select" id="anrede" name="anrede">
                  <?php foreach ($anreden as $anrede) : ?>
                      <option value="<?php echo $anrede['id']; ?>"><?php echo $anrede['anrede']; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="form-group">
            <label for="titelvor">Titel vor</label>
            <input type="text" class="form-control" id="titelvor" name="titelvor">
          </div>
          <div class="form-group">
            <label for="nachname">Nachname</label>
            <input type="text" class="form-control" id="nachname" name="nachname">
          </div>
          <div class="form-group">
            <label for="vorname">Vorname</label>
            <input type="text" class="form-control" id="vorname" name="vorname">
          </div>
          <div class="form-group">
            <label for="titelnach">Titel nach</label>
            <input type="text" class="form-control" id="titelnach" name="titelnach">
          </div>
          <div class="form-group">
            <label for="firma">Firma</label>
            <input type="text" class="form-control" id="firma" name="firma">
          </div>
          <div class="form-group">
            <label for="strasse">Straße</label>
            <input type="text" class="form-control" id="strasse" name="strasse">
          </div>
          <div class="form-group">
            <label for="plz">PLZ</label>
            <input type="text" class="form-control" id="plz" name="plz">
          </div>
          <div class="form-group">
            <label for="ort">Ort</label>
            <input type="text" class="form-control" id="ort" name="ort">          
          </div>
          <div class="form-group">
            <label for="telefon">Telefon</label>
            <input type="text" class="form-control" id="telefon" name="telefon">
          </div>
          <div class="form-group">
            <label for="telefon2">Telefon2</label>
            <input type="text" class="form-control" id="telefon2" name="telefon2">
          </div>
          <div class="form-group">
            <label for="mail">E-Mail</label>
            <input type="email" class="form-control" id="mail" name="mail">
          </div>
          <div class="form-group">
            <label for="kundeseit">Kunde seit</label>
            <input type="date" class="form-control" id="kundeseit" name="kundeseit">
          </div>
          <div class="form-group">
            <label for="fax">Fax</label>
            <input type="text" class="form-control" id="fax" name="fax">
          </div>
          <div class="form-group">
            <label for="kommentar">Kommentar</label>
            <input type="text" class="form-control" id="kommentar" name="kommentar">
          </div>
                         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
          <button type="submit" class="btn btn-primary">Speichern</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="update.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Eintrag aktualisieren</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="update_kundenNr" name="kundenNr">
          <div class="form-group">
              <label for="update_Anrede" class="form-label">Anrede</label>
              <select class="form-select" id="update_Anrede" name="anrede">
                  <?php foreach ($anreden as $anrede) : ?>
                      <option value="<?php echo $anrede['id']; ?>"><?php echo $anrede['anrede']; ?></option>
                  <?php endforeach; ?>
              </select>
          </div>
          <div class="form-group">
            <label for="update_Titelvor">Titel vor</label>
            <input type="text" class="form-control" id="update_Titelvor" name="titelvor">
          </div>
          <div class="form-group">
            <label for="update_Nachname">Nachname</label>
            <input type="text" class="form-control" id="update_Nachname" name="nachname" required>
          </div>
          <div class="form-group">
            <label for="update_Vorname">Vorname</label>
            <input type="text" class="form-control" id="update_Vorname" name="vorname" required>
          </div>
          <div class="form-group">
            <label for="update_Titelnach">Titel nach</label>
            <input type="text" class="form-control" id="update_Titelnach" name="titelnach">
          </div>
          <div class="form-group">
            <label for="update_Firma">Firma</label>
            <input type="text" class="form-control" id="update_Firma" name="firma">
          </div>
          <div class="form-group">
            <label for="update_Strasse">Straße</label>
            <input type="text" class="form-control" id="update_Strasse" name="strasse">
          </div>
          <div class="form-group">
            <label for="update_PLZ">PLZ</label>
            <input type="text" class="form-control" id="update_PLZ" name="plz">
          </div>
          <div class="form-group">
            <label for="update_Ort">Ort</label>
            <input type="text" class="form-control" id="update_Ort" name="ort">
          </div>
          <div class="form-group">
            <label for="update_Telefon">Telefon</label>
            <input type="text" class="form-control" id="update_Telefon" name="telefon">
          </div>
          <div class="form-group">
            <label for="update_Telefon2">Telefon2</label>
            <input type="text" class="form-control" id="update_Telefon2" name="telefon2">
          </div>
          <div class="form-group">
            <label for="update_Mail">E-Mail</label>
            <input type="email" class="form-control" id="update_Mail" name="mail">
          </div>
          <div class="form-group">
            <label for="update_Kundeseit">Kunde seit</label>
            <input type="date" class="form-control" id="update_Kundeseit" name="kundeseit">
          </div>
          <div class="form-group">
            <label for="update_Fax">Fax</label>
            <input type="text" class="form-control" id="update_Fax" name="fax">
          </div>
          <div class="form-group">
            <label for="update_Kommentar">Kommentar</label>
            <input type="text" class="form-control" id="update_Kommentar" name="kommentar">
          </div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
          <button type="submit" class="btn btn-primary">Aktualisieren</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bestätigungsmodal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Eintrag löschen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Sind Sie sicher, dass Sie diesen Eintrag löschen möchten?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
        <button type="button" class="btn btn-danger" id="deleteBtn">Löschen</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>

function setUpdateData(kundenNr, anrede, titelvor, nachname, vorname, titelnach, firma, strasse, plz, ort, telefon, telefon2, mail, kundeseit, fax, kommentar,) {
  document.getElementById('update_kundenNr').value = kundenNr;
  document.getElementById('update_Anrede').value = anrede;
  document.getElementById('update_Titelvor').value = titelvor;
  document.getElementById('update_Nachname').value = nachname;
  document.getElementById('update_Vorname').value = vorname;
  document.getElementById('update_Titelnach').value = titelnach;
  document.getElementById('update_Firma').value = firma;
  document.getElementById('update_Strasse').value = strasse;
  document.getElementById('update_PLZ').value = plz;
  document.getElementById('update_Ort').value = ort;
  document.getElementById('update_Telefon').value = telefon;
  document.getElementById('update_Telefon2').value = telefon2;
  document.getElementById('update_Mail').value = mail;
  document.getElementById('update_Kundeseit').value = kundeseit;
  document.getElementById('update_Fax').value = fax;
  document.getElementById('update_Kommentar').value = kommentar;
}

document.addEventListener("DOMContentLoaded", function() {
  var deleteModal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'), {
    keyboard: false
  });
  var deleteBtn = document.getElementById('deleteBtn');

  document.querySelectorAll('.deleteButton').forEach(function(button) {
    button.addEventListener('click', function(event) {
      var id = button.getAttribute('data-id');
      deleteBtn.onclick = function() {
        var form = document.createElement('form');
        form.method = 'POST';
        form.action = 'delete.php'; // Pfad zum PHP-Skript, das den Löschvorgang verarbeitet

        var hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'id';
        hiddenField.value = id;

        form.appendChild(hiddenField);
        document.body.appendChild(form);
        form.submit();
      };
    });
  });
});


</script>

</body>
</html>
