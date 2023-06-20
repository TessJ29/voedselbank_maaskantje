<?php require APPROOT . '/views/includes/head.php'; ?>
<h4><?= $data['message']; ?></h4>
<h3><?= $data['title'] ?></h3>
<h4>Studentnaam: <?= $data['student']; ?></h4>
<table>
    <thead>
        <th>id</th>
        <th>datum</th>
        <th>onderdeel</th>
        <th>Opmerkingen</th>
    </thead>
    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>
<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>
