<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
?>
<a href="<?= URLROOT; ?>/packages/create">create</a>
<table>
  <thead>
    <th>Pakket id</th>
    <th>Uitgifte datum</th>
    <th>Familie naam</th>
    <th>Aantal producten</th>
    <th>Bewerk</th>
    <th>Verwijder</th>
  </thead>
  <tbody>
    <?= $data['packages'] ?>
  </tbody>
</table>
<a href="<?= URLROOT; ?>/homepages/index">terug</a>