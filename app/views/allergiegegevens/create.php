<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/allergiegegevens/create" method="post">
    <table>
        <tbody>

            <tr>
                <td>
                    <label for="voornaam">Voornaam</label>
                    <input type="text" id="voornaam" name="voornaam" >
                </td>
            </tr>

            <tr>
                <td>
                    <label for="tussenvoegsel">Tussenvoegsel</label>
                    <input type="text" id="tussenvoegsel" name="tussenvoegsel" >
                </td>
            </tr>

            <tr>
                <td>
                    <label for="achternaam">Achternaam</label>
                    <input type="text" id="achternaam" name="achternaam" >
                </td>
            </tr>

            <tr>
                <td>
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="mobile">Mobiel</label>
                    <input type="number" name="mobile" id="mobile">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="opmerking">Opmerking</label>
                    <input type="text" name="opmerking" id="opmerking">
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