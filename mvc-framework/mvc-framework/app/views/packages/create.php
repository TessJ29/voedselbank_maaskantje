<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
?>

<form action="<?= URLROOT ?>/packages/addPackage" method="post">
  <div>
    <label for="InputReason">Uitgifte Datum</label>
    <input type="date" id="uitgifteDatum" name="uitgifteDatum">
  </div><br>
  <button type="submit">Verstuur</button>
</form>

<a href="<?= URLROOT; ?>/homepages/index">terug</a>