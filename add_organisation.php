<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body class="bg-light">

<div id="main" class="bg-light">
  <?php
  include 'top.php';
  require 'database.php';
    ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Add new organisation...</h4>
  <p>Please enter the details below and click submit to go ahead.</p>
</div>

<div class="container ml-5">

<form name = "new_organisation" method="POST" action = "org_changed.php?action=add">
<div id="form_container">

  <label for ="account_name">Organisation name:</label>
<input name="accountname" class="form-control" id="accountname" type="text" required>

  <label for ="address">Street address:</label>
<input name="address" class="form-control" id="address" type="text" required>

  <label for ="city">City:</label>
<input name="city" class="form-control" id="city" type="text" required>

  <label for ="postcode">Postcode:</label>
<input name="postcode" class="form-control" id="postcode" type="text" required>

  <label for ="website">Website:</label>
<input name="website" class="form-control" id="email" type="text" required>

  <label for ="phone">Phone:</label>
<input name="phone" class="form-control" id="phone" type="number" required>

<label for ="accountcode">Account_code:</label>
<input name="accountcode" class="form-control" id="accountcode" type="text" required>
</div>

<div class= "row mt-3">
<input type="submit" class="btn btn-primary" id="button">
<a href="all_organisations.php" class="btn btn-warning" id="button">Cancel</a></div>

</form>

</div>
</div>
</body>



</html>
