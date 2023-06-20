<?= $data['title']; ?>

<!-- < ?php var_dump($data["row"]); ?> -->

<h5>Voornaam: <?= $data['isim']; ?></h5><br>


<form action="<?= URLROOT; ?>/contactgegevens/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="email" id="email" value="<?= $data["row"]->email; ?>">
                </td>

            <tr>
                <td>
                    <input type="number" name="mobile" id="mobile" value="<?= $data["row"]->mobile; ?>">
                </td>
            </tr>
            </tr>
            <tr>
                <td>
                    <input type="text" name="opmerking" id="opmerking" value="<?= $data["row"]->opmerking; ?>">
                </td>
            </tr>
            <input type="hidden" name="Id" value="<?= $data["row"]->Id ?>">
            
            <td>
                <input type="submit" value="Bewerken">
            </td>
            </tr>
        </tbody>
    </table>

</form>