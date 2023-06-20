<?php require APPROOT . '/views/includes/head.php'; ?>
<?= $data['message']; ?>
<h3><?= $data['title']; ?></h3>
<h4>Naam student: <?= $data["student"]; ?></h4>


<table>
    <thead>
        <th>LesNr</th>
        <th>Datum</th>
        <th>tijd</th>
        <th>Instructeur</th>
        <th>Annuleer</th>
    </thead>
    <tbody>
        <?= $data['rows'] ?>
    </tbody>
</table>

<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>
