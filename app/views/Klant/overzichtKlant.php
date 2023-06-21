<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div stylee="margin-top: 5%;">
    <h1><?= $data['title']; ?></h1>
</div>
<section>
    <table border="1">
        <thead>
            <tr>
                <th>Naam Gezin</th>
                <th>Vertegenwoordiger</th>
                <th>E-mailadres</th>
                <th>Mobiel</th>
                <th>Adres</th>
                <th>Woonplaats</th>
                <th>Klant Details</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['klanten'] as $klant) : ?>
                <tr>
                    <td><?= $klant->Naam; ?></td>
                    <td><?= $klant->VolledigNaam; ?></td>
                    <td><?= $klant->Email; ?></td>
                    <td><?= $klant->Mobiel; ?></td>
                    <td><?= $klant->Adres; ?></td>
                    <td><?= $klant->Woonplaats ?></td>
                    <td><a href="<?= URLROOT; ?>/Klant/editKlant/<?= $klant->PersoonId ?>" class="button"><ion-icon name="journal-outline"></ion-icon></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="message">
        <h4><?= $data['message'];?></h4>
    </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>