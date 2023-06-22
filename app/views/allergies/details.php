<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
?>

<table>
  <thead>
    <th>Gezinsnaam</th>
    <th>Omschrijving</th>
    <th>Totaal aantal personen</th>
  </thead>
  <tbody>
    <?= $data['Details'] ?>
  </tbody>
</table>

<br>

<table>
  <thead>
    <th>Naam</th>
    <th>Type persoon</th>
    <th>Gezinsrol</th>
    <th>Allergie</th>
    <th>Wijzig allergie</th>
  </thead>
  <tbody>
    <?= $data['Allergies'] ?>
  </tbody>
</table>

<br>
<a href="<?= URLROOT; ?>/allergies">terug</a>