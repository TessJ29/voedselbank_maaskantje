<link rel="stylesheet" href="../../../public/css/style.css">



<h2 class="text-green">Wijzig voedselpakket status</h2>


<form action="<?= URLROOT; ?>/voedselpakket/wijzig" method="post">
    <select id="status" name="status" style="margin-right: 1rem;" <?php if ($data['isActief'] == 0) : ?> disabled <?php endif ?>>
        <option value="NietUitgereikt" <?php if ($data['status'] == "NietUitgereikt") : ?> selected="selected" <?php endif ?>>Niet Uitgereikt</option>
        <option value="Uitgereikt" <?php if ($data['status'] == "Uitgereikt") : ?> selected="selected" <?php endif ?>>Uitgereikt</option>
    </select>
    <input class="mb-2" type="hidden" name="id" value="<?= $data['id']; ?>">
    <input class="mb-2" type="hidden" name="gezinId" value="<?= $data['gezinId']; ?>">

    <input type="submit" value="Wijzig status voedselpakket" <?php if ($data['isActief'] == 0) : ?> disabled <?php endif ?>>

</form>
<?php if ($data['isActief'] == 0) : ?> <p>Dit gezin is niet meer ingeschreven bij de voedselbank en daarom kan er geen voedselpakket
        worden uitgereikt</p> <?php endif ?>


<a href="../index">Terug</a>
<a href="/landingspages/index">Home</a>




<?php require(APPROOT . '/views/includes/Footer.php'); ?>