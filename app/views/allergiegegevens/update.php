<?= $data['title']; ?>

<!-- < ?php var_dump($data["row"]); ?> -->

<!-- <h5>gezinsnaam: < ?= $data['isim']; ?></h5><br> -->

<form action="<?= URLROOT; ?>/allergiegegevens/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <input type="text" name="allergienaam" id="allergienaam" value="<?= $data["row"]->allergienaam; ?>">
                </td>

            <tr>
                <td>
                    <input type="text" name="comment" id="comment" value="<?= $data["row"]->comment; ?>">
                </td>
            </tr>
            </tr>

            <input type="hidden" name="Id" value="<?= $data["row"]->Id ?>">

            <td>
                <input type="submit" value="Bewerken">
            </td>
            </tr>
        </tbody>
    </table>

</form>