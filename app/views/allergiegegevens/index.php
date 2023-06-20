<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>AllergieGegevens</title>
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/style.css">

</head>

<body>
    <!-- navbar -->
    <nav>
        <div class="logo">
            <img src="\img\png.png" alt="Logo">
        </div>
        <ul>
            <li><a href="http://www.examenallergie.nl">Home</a></li>
        </ul>
    </nav>

    <table border=1>
        <thead>
            <th>Klant Naam</th>
            <th>Voedsel</th>
            <th>Allergie Naam</th>
            <th>Opmerking</th>
            <th>EDİT</th>
            <th>DELETE</th>
        </thead>
        <tbody>
            <?= $data['rows']; ?>
        </tbody>
    </table>

    <!-- create  -->

    <a href="<?= URLROOT; ?>/allergiegegevens/create">Nieuw Allergiegegevens</a>


</body>


</html>