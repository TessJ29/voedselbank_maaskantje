<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div style="text-align: center;">
    <h1><?= $data['title']; ?></h1>
</div>

<section>
    <div class="grid-container">
        <div class="grid-item">
            <h5>Voornaam:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->voornaam; ?></p>
        </div>
        <div class="grid-item">
            <h5>Tussenvoegsel:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Tussenvoegsel; ?></p>
        </div>
        <div class="grid-item">
            <h5>Achternaam:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Achternaam; ?></p>
        </div>
        <div class="grid-item">
            <h5>Geboortedatum:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Geboortedatum; ?></p>
        </div>
        <div class="grid-item">
            <h5>TypePersoon:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->TypePersoon; ?></p>
        </div>
        <div class="grid-item">
            <h5>Vertegenwoordiger:</h5>
        </div>
        <div class="grid-item">
            <p><?php if ($data['klant']->IsVertegenwoordiger == 1) {
                    echo "Ja";
                } else {
                    echo "Nee";
                }; ?></p>
        </div>
        <div class="grid-item">
            <h5>Straatnaam:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Straat; ?></p>
        </div>
        <div class="grid-item">
            <h5>Huisnummer:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Huisnummer; ?></p>
        </div>
        <div class="grid-item">
            <h5>Toevoeging:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Toevoeging; ?></p>
        </div>
        <div class="grid-item">
            <h5>Postcode:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Postcode; ?></p>
        </div>
        <div class="grid-item">
            <h5>Woonplaats:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Woonplaats; ?></p>
        </div>
        <div class="grid-item">
            <h5>Email:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Email; ?></p>
        </div>
        <div class="grid-item">
            <h5>Mobiel:</h5>
        </div>
        <div class="grid-item">
            <p><?= $data['klant']->Mobiel; ?></p>
        </div>
    </div>
    <div style="width: 40%;" class="buttons">
        <div>
            <button style="border: none; background-color: white;"><a class="klnt_btn" href="<?= URLROOT; ?>/Klanten/editKlant/<?=$data['klant']->PersoonId?>">Wijzigen</a></button>
        </div>
        <div>
            <button style="border: none; background-color: white;"><a class="klnt_btn" href="<?= URLROOT; ?>/Klanten/overzichtKlant">Terug</a></button>
            <button style="border: none; background-color: white;"><a class="klnt_btn" href="<?= URLROOT; ?>/Homepages/index">Home</a></button>
        </div>
    </div>

</section>