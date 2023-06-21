<h3><u><?= $data['title'] ?></u></h3><br>

<?php if ($data['leverancier']) : ?>
    <table border="1">
        <tr>
            <th>Naam leverancier</th>
            <th>Leveranciernummer</th>
            <th>LeverancierType</th>
        </tr>
        <tr>
            <td><?= $data['leverancier']->Naam ?></td>
            <td><?= $data['leverancier']->LeverancierNummer ?></td>
            <td><?= $data['leverancier']->LeverancierType ?></td>
        </tr>
    </table>
    &nbsp;
    <?php if ($data['products']) : ?>
        <table border="1">
            <tr>
                <th>Naam Product</th>
                <th>Soort Allergie</th>
                <th>Barcode</th>
                <th>Houdsbaarheiddatum</th>
                <th>Update</th>
            </tr>
            <?php foreach ($data['products'] as $product) : ?>
                <tr>
                    <td><?= $product->Pnaam ?></td>
                    <td><?= $product->SoortAllergie ?></td>
                    <td><?= $product->Barcode ?></td>
                    <td><?= $product->Houdbaarheidsdatum ?></td>
                    <td><a href="<?= URLROOT ?>/leverancier/update/<?= $product->leverId ?>">Update</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <p>Geen producten voor deze leverancier.</p>
    <?php endif; ?>
<?php else : ?>
    <p>Geen data voor deze leverancier.</p>
<?php endif; ?>