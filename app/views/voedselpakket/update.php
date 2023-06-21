<?php //var_dump($data['row']); 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overzicht Klanten</title>
</head>

<body>
    <h3><?= $data['title']; ?> </h3>

    <h4><?= $data['rows']; ?></h4> <br>




    <table border='1'>
        <thead>
            <th>PakketNummer</th>
            <th>Datum Samenstelling</th>
            <th>Datum Uitgifte</th>
            <th>Status </th>
            <th> Aantal Producten</th>
            <th>Wijzig Status</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>
    <a href="<?= URLROOT; ?>/homepages/index">Homepage</a>
    <a href="<?= URLROOT; ?>/voedselpakket/index">Terug</a>

</body>

</html>