<?php require(APPROOT . '/views/includes/header.php'); ?>
<?php require(APPROOT . '/views/includes/navbar.php'); ?>
echo $data["title"];
?>

<form id="form" action="<?= URLROOT; ?>/allergies/filter" method="post">
  <label for="Filter">Selecteer alergie</label>
  <select id="allergie" name="allergie" onchange="submit()">
    <option value=1 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 1) {
                      echo 'selected';
                    } ?>>Gluten</option>
    <option value=2 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 2) {
                      echo 'selected';
                    } ?>>Pindas</option>
    <option value=3 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 3) {
                      echo 'selected';
                    } ?>>Schaaldieren</option>
    <option value=4 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 4) {
                      echo 'selected';
                    } ?>>Hazelnoten</option>
    <option value=5 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 5) {
                      echo 'selected';
                    } ?>>Lactose</option>
    <option value=6 <?php if (isset($_POST['allergie']) && $_POST['allergie'] == 6) {
                      echo 'selected';
                    } ?>>Soja</option>
  </select>

  <input type="submit">
</form>

<?php if ($data["error"] == 'er zijn geen gezinnen die de geselecteerde allergie hebben');

else {
  echo "
<table>
  <thead>

    <th>Naam</th>
    <th>Omschrijving</th>
    <th>Volwassenen</th>
    <th>Kinderen</th>
    <th>Babys</th>
    <th>Vertegenwoordiger</th>
    <th>Allergie details</th>
  </thead>
  <tbody>
    " . $data['allergies'] . "
  </tbody>
</table>
";
} ?>
<br>
<?php echo $data["error"]; ?>
<br>
<a href="<?= URLROOT; ?>/homepages/index">terug</a>