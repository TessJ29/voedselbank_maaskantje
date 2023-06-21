
<div stylee="margin-top: 5%;">
    <h1><?= $data['title']; ?></h1>
</div>
<section>
    <div class="filter">
        <form action="<?= URLROOT; ?>/voedselpakket/overzichtvoedselpakket" method="post">
            <table class="filter">
                <tbody>
                    <tr>
                        <td>
                            <select name="eetwens" id="Naam" required>
                                <option value="" disabled selected>Select an option</option>
                                <option value="GeenVarken">GeenVarken</option>
                                <option value="Veganistisch">Veganistisch</option>
                                <option value="Vegetarisch">Vegetarisch</option>
                                <option value="Omnivoor">Omnivoor</option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" value="Toon Gezinnennn">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>


        <table border="1">
            <thead>
                <tr>
                    <th>Naam</th>
                    <th>Omschrijving</th>
                    <th>Volwassenen</th>
                    <th>Kinderen </th>
                    <th>Babys</th>
                    <th>Vertegenwoordiger</th>
                    <th>Voedselpakket Details </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['eetwens'] as $voedselpakket) : ?>
                    <tr>
                        <td><?= $voedselpakket->Voornaam; ?></td>
                        <td><?= $voedselpakket->Omschrijving; ?></td>
                        <td><?= $voedselpakket->AantalVolwassenen; ?></td>
                        <td><?= $voedselpakket->AantalKinderen; ?></td>
                        <td><?= $voedselpakket->AantalBabys; ?></td>
                        <td><?= $voedselpakket->IsVertegenwoordiger ?></td>
                        <td><a href="<?= URLROOT; ?>/Voedselpakket/editVoedselpakket/<?= $voedselpakket->PersoonId ?>" class="button"><ion-icon name="journal-outline"></ion-icon></a></td>
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
