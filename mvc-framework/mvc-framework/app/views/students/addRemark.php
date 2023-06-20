<?php require APPROOT . '/views/includes/head.php'; ?>

<h3><?= $data['title']; ?></h3>

<form action="<?= URLROOT; ?>/Students/addRemark" method="post">
<label for="remark">Opmerking</label>
    <input type="text" name="remark" id="remark">
    <div class="errorForm"><?= $data['remarkError']; ?></div>
    <input type="hidden" name="Id" value="<?= $data['Id']; ?>">
    <input type="submit" value="Sla Op">
</form>
<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>
