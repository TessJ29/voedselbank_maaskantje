<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
echo 'bewerkt familie ' . $data["id"];
?>
<table>
  <thead>
    <th>Productnaam</th>
    <th>Aantal</th>
    <th width="100px">+</th>
    <th width="100px">-</th>
    <th>vooraad</th>
  </thead>
  <tbody>
    <?= $data['packages'] ?>
  </tbody>
</table>


<a href="<?= URLROOT; ?>/packages">terug</a>