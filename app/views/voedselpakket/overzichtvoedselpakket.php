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
                <?php if (is_array($data['eetwens']) || is_object($data['eetwens'])) : ?>
                    <?php foreach ($data['eetwens'] as $voedselpakket) : ?>
                        <tr>
                            <td><?= $voedselpakket->Voornaam; ?></td>
                            <td><?= $voedselpakket->Omschrijving; ?></td>
                            <td><?= $voedselpakket->AantalVolwassenen; ?></td>
                            <td><?= $voedselpakket->AantalKinderen; ?></td>
                            <td><?= $voedselpakket->AantalBabys; ?></td>
                            <td><?= $voedselpakket->IsVertegenwoordiger ?></td>
                            <td><a href="<?= URLROOT; ?>/voedselpakket/editVoedselpakket/<?= $voedselpakket->id ?>" class="button"><img src='\img\kutu.png' alt='klaem'></a></td>


                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>



        </table>
        <div class="message">
            <?php if ($data['message'] == NULL) : ?>
                <h4><?= $data['message']; ?></h4>
            <?php else : ?>
                <h4 ><?= $data['message']; ?></h4>
            <?php endif; ?>
        </div>

        <div class="button">
            <button ><a href="<?= URLROOT; ?>/Homepages/index" >Home</a></button>
        </div>
</section>