<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div stylee="margin-top: 5%;">
    <h1><?= $data['title']; ?></h1>
</div>
<section>
    <div class="filter">
        <form action="<?= URLROOT; ?>/Klanten/overzichtKlant" method="post">
            <table class="filter">
                <tbody>
                    <tr>
                        <td>
                            <select name="Postcode" id="Postcode" required>
                                <option value="" disabled selected>Select an option</option>
                                <option value="5271TH">5271TH</option>
                                <option value="5271ZE">5271ZE</option>
                                <option value="5271TJ">5271TJ</option>
                                <option value="5271ZH">5271ZH</option>
                            </select>
                        </td>
                        <td>
                            <input style="width: 100%;" type="submit" value="Toon Klanten">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
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
                        <td><a href="<?= URLROOT; ?>/Klanten/klantDetails/<?= $klant->PersoonId ?>" class="button"><ion-icon name="journal-outline"></ion-icon></a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="message">
            <?php if ($data['message'] == NULL) : ?>
                <h4><?= $data['message']; ?></h4>
            <?php else : ?>
                <h4 style="width: 88%; padding: 1rem; color: black; background-color: #fad48e; border-radius: 5px; font-size: 24px; text-align: center;"><?= $data['message']; ?></h4>
            <?php endif; ?>
        </div>

        <div class="button">
            <button style="background-color: blue; padding: 1rem; margin: 0% 5% 5% 0%; float: right;"><a href="<?= URLROOT; ?>/Homepages/index" style="color: white;">Home</a></button>
        </div>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>