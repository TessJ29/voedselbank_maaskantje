<h3><u><?= $data['title']; ?></u></h3><br>
<h5>Aantal Klanten: <?= $data['amountOfKlanten']; ?></h5><br>

<a href="<?= URLROOT; ?>/klant/create">Nieuw record</a>
<table border=1>
    <thead>
        <th>Gezinsnaam</th>
        <th>Adres</th>
        <th>Postcode</th>
        <th>telefoon</th>
        <th>email</th>
        <th>Aantal volwassenen</th>
        <th>Aantal kinderen</th>
        <th>Aantal baby's</th>
        <th>Speciale wensen</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>