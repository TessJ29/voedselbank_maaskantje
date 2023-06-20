<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
echo 'bewerkt familie ' . $data["name"];
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
<a href="<?= URLROOT; ?>/homepages/index">terug</a>