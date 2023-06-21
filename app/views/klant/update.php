<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/klant/update" method="post">

    <table>
        <tbody>
            <tr>
                <td>
                    <p>Gezinsnaam</p>
                    <input type="text" name="gezinsnaam" id="gezinsnaam" value="<?= $data["row"]->gezinsnaam; ?>">
                    <p>Adres</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="adres" id="adres" value="<?= $data["row"]->adres; ?>">
                    <p>Postcode</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="postcode" id="postcode" value="<?= $data["row"]->postcode; ?>">
                    <p>Telefoonnummer</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="telefoon" id="telefoon" value="<?= $data["row"]->telefoon; ?>">
                    <p>E-mail</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="email" id="email" value="<?= $data["row"]->email; ?>">
                    <p>Aantal volwassenen 18+ jaar</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="aantalvolwassenen" id="aantalvolwassenen" value="<?= $data["row"]->aantalvolwassenen; ?>">
                    <p>Aantal kinderen 2-18 jaar</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="aantalkinderen" id="aantalkinderen" value="<?= $data["row"]->aantalkinderen; ?>">
                    <p>Aantal baby's 0-2 jaar</p>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="aantalbaby" id="aantalbaby" value="<?= $data["row"]->aantalbaby; ?>">
                    <p>Speciale wens. Ook allergieën</p>
                </td>
            </tr>

            <tr>
                <td>
                    <input list="browsers" name="wens" id="wens" value="<?= $data["row"]->wens; ?>">
                </td>
                <datalist id="browsers">
                    <option value="Geen Wens">
                    <option value="Vegetarisch">
                    <option value="Veganistisch">
                    <option value="Geen varkensvlees">
                </datalist>
            </tr>
            <tr>
                <td>
                    <input type="hidden" id="id" name="id" value="<?= $data["row"]->id; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Verzenden">
                </td>
            </tr>
        </tbody>
    </table>

</form>