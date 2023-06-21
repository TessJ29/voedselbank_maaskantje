<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
<div style="text-align: center; padding-top: 1rem;">
    <h1><?= $data['title']; ?></h1>
</div>

<section>
    <!-- kijkt of $data['message] leeg is. Zo niet dan wordt of de eerste of tweede uitgevoerd -->
    <?php if (empty($data['message'])) : ?>
    <?php elseif ($data['message'] == "De klantgegevens zijn gewijzigd") : ?>
        <div class="message" style="width: 50%; margin: 0 auto; background-color: #a5fca5; border-radius: 5px;">
            <h5 style="font-size: 16px;"><?= $data["message"] ?></h5>
        </div>
    <?php else : ?>
        <div class="message" style="width: 50%; margin: 0 auto; background-color: #ee8a8a; border-radius: 5px;">
            <h5 style="font-size: 16px;"><?= $data["message"] ?></h5>
        </div>
    <?php endif; ?>
    <form action="<?= URLROOT; ?>/Klanten/editKlant/<?= $data['klant']->PersoonId ?>" method="post">
        <div class="input">
            <label for="voornaam">Voornaam:</label>
            <input type="text" name="voornaam" id="voornaam" value="<?= $data['klant']->voornaam; ?>" required>
        </div>
        <div class="input">
            <label for="Tussenvoegsel">Tussenvoegsel:</label>
            <input type="text" name="Tussenvoegsel" id="Tussenvoegsel" value="<?= $data['klant']->Tussenvoegsel; ?>" required>
        </div>
        <div class="input">
            <label for="Achternaam">Achternaam:</label>
            <input type="text" name="Achternaam" id="Achternaam" value="<?= $data['klant']->Achternaam; ?>" required>
        </div>
        <div class="input">
            <label for="Geboortedatum">Geboortedatum:</label>
            <input type="date" name="Geboortedatum" id="Geboortedatum" value="<?= $data['klant']->Geboortedatum; ?>" required>
        </div>
        <div class="input">
            <label for="TypePersoon">TypePersoon:</label>
            <select style="width: 70%;" name="TypePersoon" id="TypePersoon">
                <option value="<?= $data['klant']->TypePersoon ?>"><?= $data['klant']->TypePersoon ?></option>
                <option value="Manager">Manager</option>
                <option value="Medewerker">Medewerker</option>
                <option value="Vrijwilliger">Vrijwilliger</option>
                <option value="Klant">Klant</option>
            </select>
        </div>
        <div class="input">
            <label for="IsVertegenwoordiger">Vertegenwoordiger:</label>
            <select style="width: 70%;" name="IsVertegenwoordiger" id="IsVertegenwoordiger">
            <!-- Kijkt of de klant vertegenwoordiger is en veranderd 1 en 0 naar ja of nee -->
                <option value="<?= $data['klant']->IsVertegenwoordiger ?>"><?php if ($data['klant']->IsVertegenwoordiger == 1) {
                                                                                echo "Ja";
                                                                            } else {
                                                                                echo "Nee";
                                                                            }; ?></option>
                <option value="1">Ja</option>
                <option value="2">Nee</option>
            </select>
        </div>
        <div class="input">
            <label for="Straat">Straatnaam:</label>
            <input type="text" name="Straat" id="Straat" value="<?= $data['klant']->Straat; ?>" required>
        </div>
        <div class="input">
            <label for="Huisnummer">Huisnummer:</label>
            <input type="text" name="Huisnummer" id="Huisnummer" value="<?= $data['klant']->Huisnummer; ?>" required>
        </div>
        <div class="input">
            <label for="Toevoeging">Toevoeging:</label>
            <input type="text" name="Toevoeging" id="Toevoeging" value="<?= $data['klant']->Toevoeging; ?>">
        </div>
        <div class="input">
            <label for="Postcode">Postcode:</label>
            <input type="text" name="Postcode" id="Postcode" value="<?= $data['klant']->Postcode; ?>" required>
        </div>
        <!-- kijkt of er een message wordt doorgegeven en voert dan 1 van de twee statements uit -->
        <?php if (empty($data['postmessage'])) : ?>
        <?php else : ?>
            <div style="right: 50%; color: red;" class="postmessage">
                <h5 class="txt_message"><?= $data['postmessage'] ?></h5>
            </div>
        <?php endif; ?>
        <div class="input">
            <label for="Woonplaats">Woonplaats:</label>
            <input type="text" name="Woonplaats" id="Woonplaats" value="<?= $data['klant']->Woonplaats; ?>" required>
        </div>
        <div class="input">
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="Email" value="<?= $data['klant']->Email; ?>" required>
        </div>
        <div class="input">
            <label for="Mobiel">Mobiel:</label>
            <input type="tel" name="Mobiel" id="Mobiel" value="<?= $data['klant']->Mobiel; ?>" required>
        </div>
        <div class="telmessage">
            <h5 class="txt_message" style="float: right;"><?= $data['telmessage'] ?></h5>
        </div>
        <input type="hidden" name="KlantId" value="<?= $data["klant"]->PersoonId ?>">
        <div class="buttons">
            <div>
                <input class="klnt_btn" style="width: 100%;" type="submit" value="Wijzigen">
            </div>
            <div>
                <button style="border: none; background-color: white;"><a class="klnt_btn" href="<?= URLROOT; ?>/Klanten/klantDetails/<?= $data['klant']->PersoonId ?>">Terug</a></button>
                <button style="border: none; background-color: white;"><a class="klnt_btn" href="<?= URLROOT; ?>/Homepages/index">Home</a></button>
            </div>
        </div>
    </form>
</section>