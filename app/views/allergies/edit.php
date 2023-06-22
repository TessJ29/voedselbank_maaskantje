<?php require APPROOT . '/views/includes/head.php';
echo $data["title"];
?>

<form id="" action="<?= URLROOT; ?>/allergies/editscript" method="post">
  <select id="allergie" name="allergie" onchange="">
    <option value=1 <?php if ($data["currentAlergy"] == 1) {
                      echo 'selected';
                    } ?>>Gluten</option>
    <option value=2 <?php if ($data["currentAlergy"] == 2) {
                      echo 'selected';
                    } ?>>Pindas</option>
    <option value=3 <?php if ($data["currentAlergy"] == 3) {
                      echo 'selected';
                    } ?>>Schaaldieren</option>
    <option value=4 <?php if ($data["currentAlergy"] == 4) {
                      echo 'selected';
                    } ?>>Hazelnoten</option>
    <option value=5 <?php if ($data["currentAlergy"] == 5) {
                      echo 'selected';
                    } ?>>Lactose</option>
    <option value=6 <?php if ($data["currentAlergy"] == 6) {
                      echo 'selected';
                    } ?>>Soja</option>
    <input type="hidden" name="personId" value="<?= $data['persoonsId'] ?>">
    <input type="hidden" name="gezinsId" value="<?= $data['gezinsId'] ?>">
  </select>
  <input type="submit">
</form>
<br>
<?php
if ($data['currentAlergy'] == 2) {
  echo ' <div style="border: red 3px solid; background-color: darkred; color: white;"> <p> Voor het wijzigen van deze allergie word geadviseerd eerst een arts raad te plegen vanwege een hoog risico op anafylactisch shock </p> </div>';
}

?>


<a href="<?= URLROOT; ?>/allergies">terug</a>