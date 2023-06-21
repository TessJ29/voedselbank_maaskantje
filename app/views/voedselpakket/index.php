<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht gezinnen met Voedselpakketten</title>
</head>

<body>
    <h3><?= $data['title']; ?> </h3>


    <div class="container col-4">
        <div class="row">
            <form id="get" action="<?= URLROOT; ?>/voedselpakket/index" method="POST">
                <div class="mb-3">
                    <label for="Naam" class="form-label">PakketOptie :</label>
                    <select id="Naam" name="Naam">
                        <option value="GeenVarken" <?php if ($_POST['Naam'] == 'GeenVarken') {
                                                        echo 'selected';
                                                    } ?>>GeenVarken</option>
                        <option value="Veganistisch" <?php if ($_POST['Naam'] == 'Veganistisch') {
                                                            echo 'selected';
                                                        } ?>>Veganistisch</option>
                        <option value="Vegetarisch" <?php if ($_POST['Naam'] == 'Vegetarisch') {
                                                        echo 'selected';
                                                    } ?>>Vegetarisch</option>
                        <option value="Omnivoor" <?php if ($_POST['Naam'] == 'Omnivoor') {
                                                        echo 'selected';
                                                    } ?>>Omnivoor</option>
                    </select>




                    <!-- <div class="container col-4">
        <div class="row">
            <form id="get" action="< ?= URLROOT; ?>/voedselpakket/index" method="POST">
                <div class="mb-3">
                    <label for="Naam" class="form-label">PakketOptie :</label>
                    <select id="Naam" name="Naam">
                        <option value="GeenVarken" < ?php if ($data['row']->Naam == 'GeenVarken') {
                                                        echo 'Selected';
                                                    } ?>>GeenVarken</option>
                        <option value="Veganistisch" < ?php if ($data['row']->Naam == 'Veganistisch') {
                                                            echo 'Selected';
                                                        } ?>>Veganistisch</option>
                        <option value="Vegetarisch" < ?php if ($data['row']->Naam == 'Vegetarisch') {
                                                        echo 'Selected';
                                                    } ?>>Vegetarisch</option>
                        <option value="Omnivoor" < ?php if ($data['row']->Naam == 'Omnivoor') {
                                                        echo 'Selected';
                                                    } ?>>Omnivoor</option>
                    </select> -->
                </div>
                <!-- <input type="hidden" name="AantalKinderen" value="< ?= $data['row']->AantalKinderen; ?>"> -->
                <div class="mb-3">
                    <!-- <input type="hidden" name="Id" value="< ?= $data["row"]->Id; ?>"> -->
                </div>
                <button type="submit" class="btn btn-primary">Toon Gezinnen</button>
            </form>
        </div>
    </div>


    <table border='1'>
        <thead>
            <th>Naam</th>
            <th>Omschrijving</th>
            <th>Volwassenen</th>
            <th>Kinderen </th>
            <th>Babys</th>
            <th>Vertegenwoordiger</th>
            <th>Voedselpakket Details </th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
    <a href="<?= URLROOT; ?>/homepages/index">Home</a>
    <a href="<?= URLROOT; ?>/voedselpakket/overzichtvoedselpakket">voegsel</a>

</body>

</html>