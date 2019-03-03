<div id="main" class="bg-light">
  <?php
        require 'database.php';
        ?>

<div class="container">
<h2>Modify <span id="organisation">organisation details</span>...</h2>



<!-- GET the account code to look for -->

<?php

  $id = $_GET['id'];

require 'database.php';

$sql = "SELECT * FROM account WHERE id = '" . $id . "';";

$result = $connection->query($sql);

if($result->num_rows>0){ // it's great but next time use the right method.
  while($row = $result->fetch_assoc()){

    $accountcode = $row["account_code"];
    $accountname = $row["account_name"];
    $address = $row["address"];
    $city = $row["city"];
    $postcode = $row["postcode"];
    $website = $row["website"];
    $phone = $row["phone"];

  }
}


?>


<form name = "edit_person" method="POST" action = "all_organisations.php?action=edit&id=<?php echo $id; ?>">
<div id="form_container">

  <div class="form-row">
    <div class="form-group col">
    <label for ="account_name">Organisation name:</label>
    <input name="accountname" value="<?php echo $accountname;?>" class="form-control" id="accountname" type="text" required>
    </div>

    <div class="form-group col">
    <label for ="accountcode">Account code: <small>(don't use space)</small></label>
    <input name="accountcode"  value="<?php echo $accountcode;?>"  class="form-control" id="accountcode" type="text" required pattern="\S+">
    </div>
  </div>

  <div class="form-row">
      <div class="form-group col">
      <label for ="address">Street address:</label>
      <input name="address"  value="<?php echo $address;?>"  class="form-control" id="address" type="text" required>
      </div>
  </div>

  <div class="form-row">
    <div class="form-group col">
      <label for ="city">City:</label>
      <input name="city"  value="<?php echo $city;?>"  class="form-control" id="city" type="text" required>
    </div>
    <div class="form-group col">
      <label for ="postcode">Postcode:</label>
      <input name="postcode"  value="<?php echo $postcode;?>" class="form-control" id="postcode" type="text" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col">
      <label for ="website">Website:</label>
      <input name="website"  value="<?php echo $website;?>"  class="form-control" id="email" type="text" required>
    </div>
    <div class="form-group col">
      <label for ="phone">Phone:</label>
      <input name="phone"  value="<?php echo $phone;?>"  class="form-control" id="phone" type="number" required>
    </div>
  </div>

</div>

<input type="submit" class="btn btn-primary" id="button">
<a href="all_organisations.php" class="btn btn-secondary ml-1" id="button">Cancel</a></div>

</form>
</div>
