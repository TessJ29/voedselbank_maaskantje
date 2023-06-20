<?php require APPROOT . '/views/includes/head.php'; ?>
<h3><?= $data['title'] ?></h3>

<form action="<?= URLROOT ?>/students/addReason" method="post">
  <div>
    <label for="InputReason">Reden:</label>
    <input type="text" id="InputReason" name="reason">
    <div class="errorForm"><?= $data['reasonError']; ?></div>
    <input type="hidden" name="Id" value="<?= $data['Id']; ?>">
  </div><br>
  <button type="submit">Verstuur</button>
</form>

<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>