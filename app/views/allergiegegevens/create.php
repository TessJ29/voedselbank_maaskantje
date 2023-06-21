<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/allergiegegevens/create" method="post">
    <table>
        <tbody>

            <tr>
                <td>
                    <label for="allergienaam">Allergie naam</label>
                    <input type="text" id="allergienaam" name="allergienaam">
                </td>
            </tr>

            <tr>
                <td>
                    <label for="comment">Opmerking</label>
                    <input type="text" id="comment" name="comment">
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