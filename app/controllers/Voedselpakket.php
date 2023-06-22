<div>
    <h2>Overzicht gezinnen met voedselpakketten</h2>

</div>


<table class="table table-striped">

    <tbody>
        <tr>
            <td>Naam:</td>
            <td><?= $data['naam']; ?></td>
        </tr>
        <tr>
            <td>Overzicht:</td>
            <td><?= $data['omschrijving']; ?></td>
        </tr>
        <tr>
            <td>Totaal aantal personen:</td>
            <!-- <td>< ?= $data['aantalpersonen']; ?></td> -->
        </tr>
        <!-- < ?= $data['rows']; ?> -->
    </tbody>
</table>

<table class="table table-striped">
    <thead>
        <th>Pakketnummer</th>
        <th>Datum samenstelling</th>
        <th>Datum uitgifte</th>
        <th>Status</th>
        <th>Aantal Producten</th>
        <th>Wijzig Status</th>
    </thead>
    <tbody>
        <?= $data['rows']; ?>
    </tbody>
</table>
<a class="btn-blue" href="../index" ">Terug</a>
        <a class=" btn-blue" href="/homepages/index" style="margin-left: 64rem;">Home</a>


</div>
</div>