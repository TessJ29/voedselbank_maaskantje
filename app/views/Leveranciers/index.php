<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div class="title">
    <h1><?= $data['title']; ?></h1>
</div>

<section>
    <table>
        <thead>
            <tr>
                <th>Bedrijfsnaam</th>
                <th>Adres</th>
                <th>Naam</th>
                <th>E-mailadres</th>
                <th>Telefoonnummer</th>
                <th>Datum eerstvolgende levering</th>
                <th>Tijd</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['leveranciers'] as $leverancier) : ?>
                <tr>
                    <td><?= $leverancier->bedrijfsnaam; ?></td>
                    <td><?= $leverancier->adres; ?></td>
                    <td><?= $leverancier->contactpersoon; ?></td>
                    <td><?= $leverancier->email; ?></td>
                    <td><?= $leverancier->telefoonnummer; ?></td>
                    <td><?= $leverancier->datumeerstvolgendelevering ?></td>
                    <td> <?= $leverancier->tijdeerstvolgendelevering; ?></td>
                    <td><a href="<?= URLROOT; ?>/Leveranciers/editLeverancier/<?= $leverancier->Id ?>/<?= $leverancier->productId?>" class="button"><ion-icon class="edit" name="create-outline" size="large"></ion-icon></a></td>
                    <td><a href="<?= URLROOT ?>/Leveranciers/deleteLeverancier/<?= $leverancier->Id ?>" class="button"><ion-icon class="delete" name="trash-outline" size="large"></ion-icon></a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="message">
        <h4><?= $data['message'];?></h4>
    </div>

    <div class="button">
        <button class="addLeverancier"><a href="<?= URLROOT; ?>/Leveranciers/addLeveranciers">Leverancier toevoegen</a></button>
    </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>