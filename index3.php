<?php require "inc/db-connect.php"; ?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFZ Verwaltung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid mt-5 table-responsive">
        <h2>KFZ Daten</h2>
        <div class="mt-5">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kfzModal">
                KFZ hinzufügen
            </button>
        </div>
        <div class="container-fluid mt-5 table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">LfdNr</th>
                        <th scope="col">Kundennummer</th>
                        <th scope="col">Kennzeichen</th>
                        <th scope="col">Marke</th>
                        <th scope="col">Typ</th>
                        <th scope="col">Baujahr</th>
                        <th scope="col">KM-Stand</th>
                        <th scope="col">KW</th>
                        <th scope="col">Benzin/Diesel</th>
                        <th scope="col">Türen</th>
                        <th scope="col">Kombi</th>
                        <th scope="col">Zulassung</th>
                        <th scope="col">Erstzulassung</th>
                        <th scope="col">Fahrgestellnummer</th>
                        <th scope="col">Motornummer</th>
                        <th scope="col">Hubraum</th>
                        <th scope="col">FIN</th>
                        <th scope="col">Bearbeiten</th>
                        <th scope="col">Löschen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $stmt = $pdo->prepare('SELECT * FROM kfz INNER JOIN kunden ON kfz.fkKundennummer = kunden.kundenNr');
                    $stmt->execute();

                    $stmt_kunden = $pdo->prepare("SELECT * FROM kunden");
                    $stmt_kunden->execute();
                    $kunden = $stmt_kunden->fetchAll(PDO::FETCH_ASSOC);
            
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['lfdNr']); ?></td>
                            <td><?php echo htmlspecialchars($row['fkKundennummer'] . " " . $row['nachname'] . " " . $row['vorname']); ?></td>
                            <td><?php echo htmlspecialchars($row['kennzeichen']); ?></td>
                            <td><?php echo htmlspecialchars($row['marke']); ?></td>
                            <td><?php echo htmlspecialchars($row['type']); ?></td>
                            <td><?php echo htmlspecialchars($row['baujahr']); ?></td>
                            <td><?php echo htmlspecialchars($row['kmStand']); ?></td>
                            <td><?php echo htmlspecialchars($row['kw']); ?></td>
                            <td><?php echo htmlspecialchars($row['BenzinDiesel']); ?></td>
                            <td><?php echo htmlspecialchars($row['tueren']); ?></td>
                            <td><?php echo htmlspecialchars($row['kombi']); ?></td>
                            <td><?php echo htmlspecialchars($row['zulassung']); ?></td>
                            <td><?php echo htmlspecialchars($row['erstzulassung']); ?></td>
                            <td><?php echo htmlspecialchars($row['fahrgestellnummer']); ?></td>
                            <td><?php echo htmlspecialchars($row['motornummer']); ?></td>
                            <td><?php echo htmlspecialchars($row['hubraum']); ?></td>
                            <td><?php echo htmlspecialchars($row['fin']); ?></td>
                            <td><button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateKfzModal" onclick="setUpdateData(
                                <?php echo $row['lfdNr']; ?>,
                                '<?php echo $row['fkKundennummer']; ?>',
                                '<?php echo $row['kennzeichen']; ?>',
                                '<?php echo $row['marke']; ?>',
                                '<?php echo $row['type']; ?>',
                                '<?php echo $row['baujahr']; ?>',
                                '<?php echo $row['kmStand']; ?>',
                                '<?php echo $row['kw']; ?>',
                                '<?php echo $row['BenzinDiesel']; ?>',
                                '<?php echo $row['tueren']; ?>',
                                '<?php echo $row['kombi']; ?>',
                                '<?php echo $row['zulassung']; ?>',
                                '<?php echo $row['erstzulassung']; ?>',
                                '<?php echo $row['fahrgestellnummer']; ?>',
                                '<?php echo $row['hubraum']; ?>',
                                '<?php echo $row['motornummer']; ?>',
                                '<?php echo $row['fin']; ?>')">Bearbeiten</button></td>
                            <td><button type="button" class="btn btn-danger btn-sm deleteButton" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-id="<?php echo $row['lfdNr']; ?>">Löschen</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

<!-- Modal für das Hinzufügen von KFZ -->
<div class="modal fade" id="kfzModal" tabindex="-1" aria-labelledby="kfzModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="insert_kfz.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="kfzModalLabel">Neues KFZ hinzufügen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="anrede" class="form-label">Kunde</label>
                            <select class="form-select mb-3" id="kunde" name="kunde">
                                <?php foreach ($kunden as $kunde) : ?>
                                    <option value="<?php echo $kunde['kundenNr']; ?>"><?php echo $kunde['kundenNr'] . " " . $kunde['nachname'] . " " . $kunde['vorname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="kennzeichen" class="form-label">Kennzeichen</label>
                            <input type="text" class="form-control" id="kennzeichen" name="kennzeichen" required>
                        </div>

                        <div class="mb-3">
                            <label for="marke" class="form-label">Marke</label>
                            <input type="text" class="form-control" id="marke" name="marke" required>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="mb-3">
                            <label for="baujahr" class="form-label">Baujahr</label>
                            <input type="text" class="form-control" id="baujahr" name="baujahr" required>
                        </div>

                        <div class="mb-3">
                            <label for="kmStand" class="form-label">KM-Stand</label>
                            <input type="text" class="form-control" id="kmStand" name="kmStand" required>
                        </div>

                        <div class="mb-3">
                            <label for="kw" class="form-label">KW</label>
                            <input type="text" class="form-control" id="kw" name="kw" required>
                        </div>

                        <div class="mb-3">
                            <label for="BenzinDiesel" class="form-label">Benzin/Diesel</label>
                            <input type="text" class="form-control" id="BenzinDiesel" name="BenzinDiesel" required>
                        </div>

                        <div class="mb-3">
                            <label for="tueren" class="form-label">Türen</label>
                            <input type="text" class="form-control" id="tueren" name="tueren" required>
                        </div>

                        <div class="mb-3">
                            <label for="kombi" class="form-label">Kombi</label>
                            <input type="text" class="form-control" id="kombi" name="kombi" required>
                        </div>

                        <div class="mb-3">
                            <label for="zulassung" class="form-label">Zulassung</label>
                            <input type="text" class="form-control" id="zulassung" name="zulassung" required>
                        </div>

                        <div class="mb-3">
                            <label for="erstzulassung" class="form-label">Erstzulassung</label>
                            <input type="text" class="form-control" id="erstzulassung" name="erstzulassung" required>
                        </div>

                        <div class="mb-3">
                            <label for="fahrgestellnummer" class="form-label">Fahrgestellnummer</label>
                            <input type="text" class="form-control" id="fahrgestellnummer" name="fahrgestellnummer" required>
                        </div>

                        <div class="mb-3">
                            <label for="motornummer" class="form-label">Motornummer</label>
                            <input type="text" class="form-control" id="motornummer" name="motornummer" required>
                        </div>

                        <div class="mb-3">
                            <label for="hubraum" class="form-label">Hubraum</label>
                            <input type="text" class="form-control" id="hubraum" name="hubraum" required>
                        </div>

                        <div class="mb-3">
                            <label for="fin" class="form-label">FIN</label>
                            <input type="text" class="form-control" id="fin" name="fin" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Speichern</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Update Modal -->
<div class="modal fade" id="updateKfzModal" tabindex="-1" aria-labelledby="updateKIfzModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="update_kfz.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateKfzModalLabel">Eintrag aktualisieren</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="update_lfdNr" name="lfdNr">
                        <div class="form-group">
                            <label for="update_kunde" class="form-label">Kunde</label>
                            <select class="form-select mb-3" id="update_kunde" name="kunde">
                                <?php foreach ($kunden as $kunde) : ?>
                                    <option value="<?php echo $kunde['kundenNr']; ?>"><?php echo $kunde['kundenNr'] . " " . $kunde['nachname'] . " " . $kunde['vorname']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="update_kennzeichen" class="form-label">Kennzeichen</label>
                            <input type="text" class="form-control" id="update_kennzeichen" name="kennzeichen" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_marke" class="form-label">Marke</label>
                            <input type="text" class="form-control" id="update_marke" name="marke" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_type" class="form-label">Type</label>
                            <input type="text" class="form-control" id="update_type" name="type" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_baujahr" class="form-label">Baujahr</label>
                            <input type="text" class="form-control" id="update_baujahr" name="baujahr" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_kmStand" class="form-label">KM-Stand</label>
                            <input type="text" class="form-control" id="update_kmStand" name="kmStand" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_kw" class="form-label">KW</label>
                            <input type="text" class="form-control" id="update_kw" name="kw" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_BenzinDiesel" class="form-label">Benzin/Diesel</label>
                            <input type="text" class="form-control" id="update_BenzinDiesel" name="BenzinDiesel" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_tueren" class="form-label">Türen</label>
                            <input type="text" class="form-control" id="update_tueren" name="tueren" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_kombi" class="form-label">Kombi</label>
                            <input type="text" class="form-control" id="update_kombi" name="kombi" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_zulassung" class="form-label">Zulassung</label>
                            <input type="text" class="form-control" id="update_zulassung" name="zulassung" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_erstzulassung" class="form-label">Erstzulassung</label>
                            <input type="text" class="form-control" id="update_erstzulassung" name="erstzulassung" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_fahrgestellnummer" class="form-label">Fahrgestellnummer</label>
                            <input type="text" class="form-control" id="update_fahrgestellnummer" name="fahrgestellnummer" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_motornummer" class="form-label">Motornummer</label>
                            <input type="text" class="form-control" id="update_motornummer" name="motornummer" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_hubraum" class="form-label">Hubraum</label>
                            <input type="text" class="form-control" id="update_hubraum" name="hubraum" required>
                        </div>

                        <div class="mb-3">
                            <label for="update_fin" class="form-label">FIN</label>
                            <input type="text" class="form-control" id="update_fin" name="fin" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Abbrechen</button>
                        <button type="submit" class="btn btn-primary">Speichern</button>
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
        function setUpdateData(lfdNr, kunde, kennzeichen, marke, type, baujahr, kmStand, kw, BenzinDiesel, tueren, kombi, zulassung, erstzulassung, fahrgestellnummer, motornummer, hubraum, fin) {
            document.getElementById('update_lfdNr').value = lfdNr;
            document.getElementById('update_kunde').value = kunde;
            document.getElementById('update_kennzeichen').value = kennzeichen;
            document.getElementById('update_marke').value = marke;
            document.getElementById('update_type').value = type;
            document.getElementById('update_baujahr').value = baujahr;
            document.getElementById('update_kmStand').value = kmStand;
            document.getElementById('update_kw').value = kw;
            document.getElementById('update_BenzinDiesel').value = BenzinDiesel;
            document.getElementById('update_tueren').value = tueren;
            document.getElementById('update_kombi').value = kombi;
            document.getElementById('update_zulassung').value = zulassung;
            document.getElementById('update_erstzulassung').value = erstzulassung;
            document.getElementById('update_fahrgestellnummer').value = fahrgestellnummer;
            document.getElementById('update_motornummer').value = motornummer;
            document.getElementById('update_hubraum').value = hubraum;
            document.getElementById('update_fin').value = fin;
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
        form.action = 'delete_kfz.php'; // Pfad zum PHP-Skript, das den Löschvorgang verarbeitet

        var hiddenField = document.createElement('input');
        hiddenField.type = 'hidden';
        hiddenField.name = 'lfdNr';
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
