<h3><u><?= $data['title']; ?></u></h3><br>

<form action="<?= URLROOT; ?>/leverancier/index" method="GET">
    <label for="leverancierType">Select Leverancier Type:</label>
    <select name="leverancierType" id="leverancierType">
        <option value="">Alle</option>
        <option value="Bedrijf">Bedrijf</option>
        <option value="Instelling">Instelling</option>
        <option value="Overheid">Overheid</option>
        <option value="Particulier">Particulier</option>
        <option value="Donor">Donor</option>
    </select>
    <input type="submit" value="Filter">
</form>

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