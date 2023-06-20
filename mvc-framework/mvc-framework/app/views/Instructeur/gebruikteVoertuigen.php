<?php require APPROOT . '/views/includes/head.php'; ?>
<h3><u><?= $data['title']; ?></u></h3><br>
<h5>Naam: <?= $data['voornaam'] . ' ' . $data['tussenvoegsel'] . ' ' . $data['achternaam']; ?></h5>
<h5>Datum in dienst: <?= date_format(date_create($data['datumInDienst']), 'd-m-Y'); ?></h5>
<h5>Aantal sterren: <?= $data['aantalSterren']; ?></h5><br>

<table>
    <thead>
        <th>Type Voertuig</th>
        <th>Type</th>
        <th>Kenteken</th>
        <th>Bouwjaar</th>
        <th>Brandstof</th>
        <th>Rijbewijscategorie</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>

<a href="<?= URLROOT;?>/homepages/index">home</a>
<?php require APPROOT . '/views/includes/footer.php'; ?>