<?= $data['title']; ?>

<form action="<?= URLROOT; ?>/klant/create" method="post">
  <table>
    <tbody>
      <tr>
        <td>
          <label for="gezinsnaam">gezinsnaam</label>
          <input type="text" name="gezinsnaam" id="gezinsnaam">
        </td>
      </tr>
      <tr>
        <td>
          <label for="adres">adres</label>
          <input type="text" name="adres" id="adres">
        </td>
      </tr>
      <tr>
        <td>
          <label for="postcode">postcode</label>
          <input type="text" name="postcode" id="postcode">
        </td>
      </tr>
      <tr>
        <td>
          <label for="telefoon">telefoon</label>
          <input type="text" name="telefoon" id="telefoon">
        </td>
      </tr>
      <tr>
        <td>
          <label for="email">email</label>
          <input type="text" name="email" id="email">
        </td>
      </tr>
      <tr>
        <td>
          <label for="aantalvolwassenen">aantalvolwassenen</label>
          <input type="text" name="aantalvolwassenen" id="aantalvolwassenen">
        </td>
      </tr>
      <tr>
        <td>
          <label for="aantalkinderen">aantalkinderen</label>
          <input type="text" name="aantalkinderen" id="aantalkinderen">
        </td>
      </tr>
      <tr>
        <td>
          <label for="aantalbaby">aantalbaby</label>
          <input type="text" name="aantalbaby" id="aantalbaby">
        </td>
      </tr>
      <tr>
        <td>
          <label for="wens">wens</label>
          <input type="text" name="wens" id="wens">
        </td>
      </tr>
      <tr>
        <td>
          <input type="submit" value="Verzenden">
        </td>
      </tr>
    </tbody>
  </table>
</form>