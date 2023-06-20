<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
echo 'bewerkt familie ' . $data["id"];
?>
<table>
  <thead>
    <th>Productnaam</th>
    <th>Aantal</th>
    <th>+</th>
    <th>-</th>
  </thead>
  <tbody>
    <?= $data['packages'] ?>
  </tbody>
</table>


<a href="<?= URLROOT; ?>/packages">terug</a>