<h3><u><?= $data['title']; ?></u></h3><br>

<table border=1>
    <thead class="homepagesquare">
        <th>Naam</th>
        <th>Contactpersoon</th>
        <th>Email</th>
        <th>Mobiel</th>
        <th>Leveranciernummer</th>
        <th>leverancierType</th>
        <th>Product Details</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>