<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/leverancier/update" method="post">
    <table>
        <tbody>
            <tr>
                <td>
                    <p>Houdbaarheidsdatum aanpassen</p>
                    <input type="date" name="Houdbaarheidsdatum" id="Houdbaarheidsdatum" value="<?= $data["row"]->Houdbaarheidsdatum; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="hidden" id="LeverancierId" name="LeverancierId" value="<?= $data["row"]->leverId; ?>">
                    <input type="hidden" id="ProductId" name="ProductId" value="<?= $data["row"]->ProductId; ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <input type="submit" value="Wijzig Houdbaarheidsdatum">
                </td>
            </tr>
        </tbody>
    </table>
</form>