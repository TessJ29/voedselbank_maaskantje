<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div class="title">
    <h1><?= $data['title']; ?></h1>
</div>

<section>
    <form action="<?= URLROOT; ?>/Leveranciers/editLeverancier/<?=$data['leverancier']->Id?>" method="post">
        <div>
            <label for="bedrijfsnaam">Bedrijfsnaam:</label>
            <input type="text" name="bedrijfsnaam" id="bedrijfsnaam" placeholder="<?=$data['leverancier']->bedrijfsnaam;?>" required>
        </div>
        <div>
            <label for="adres">Adres:</label>
            <input type="text" name="adres" id="adres" placeholder="<?=$data['leverancier']->adres;?>" required>
        </div>
        <div>
            <label for="contactpersoon">Contactpersoon:</label>
            <input type="text" name="contactpersoon" id="contactpersoon"  placeholder="<?=$data['leverancier']->contactpersoon;?>"required>
        </div>
        <div>
            <label for="email">E-mailadres:</label>
            <input type="email" name="email" id="email" placeholder="<?=$data['leverancier']->email;?>" required>
        </div>
        <div>
            <label for="telefoonnummer">Telefoonnummer:</label>
            <input type="tel" name="telefoonnummer" id="telefoonnummer" placeholder="<?=$data['leverancier']->telefoonnummer;?>" required>
        </div>
        <div>

        </div>
        <button><a href="<?= URLROOT; ?>/Leveranciers/index">Terug</a></button>

        <input type="hidden" name="LeverancierId" value="<?= $data["leverancier"]->Id ?>">
        <input type="hidden" name="productId" value="<?= $data["leverancier"]->productId ?>">

        <input type="submit" value="Wijzigen">
        <h5><?= $data['message']?></h5>
    </form>
</section>