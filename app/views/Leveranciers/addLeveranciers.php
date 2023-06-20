<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div class="title">
    <h1><?= $data['title']; ?></h1>
</div>

<section>
    <form action="<?= URLROOT; ?>/Leveranciers/addLeveranciers" method="post">
        <div>
            <label for="bedrijfsnaam">Bedrijfsnaam:</label>
            <input type="text" name="bedrijfsnaam" id="bedrijfsnaam" required>
        </div>
        <div>
            <label for="adres">Adres:</label>
            <input type="text" name="adres" id="adres" required>
        </div>
        <div>
            <label for="contactpersoon">Contactpersoon:</label>
            <input type="text" name="contactpersoon" id="contactpersoon" required>
        </div>
        <div>
            <label for="email">E-mailadres:</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="telefoonnummer">Telefoonnummer:</label>
            <input type="tel" name="telefoonnummer" id="telefoonnummer" required>
        </div>
        <div>
            <label for="productId">product:</label>
            <select name="productId" id="productId" required>
                <?php foreach ($data['leveranciers'] as $leverancier) : ?>
                    <option value="<?= $leverancier->productId ?>"><?= $leverancier->productnaam ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button><a href="<?= URLROOT; ?>/Leveranciers/index">Terug</a></button>

        <input type="submit" value="Toevoegen">
        <h5><?= $data['message']?></h5>
    </form>
</section>