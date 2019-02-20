<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body>
<div id="main">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Add new person to a company...</h4>
  <p>Please enter the details below and click submit to go ahead.</p>
</div>

<div class="container">
<form name = "new_person" method="POST" action = "person_changed.php?action=add">
<div id="form_container">

<div class="form-row">
  <div class="form-group col-md-4">
  <label for ="firstname">First name:</label>
<input name="firstname" class="form-control" id="firstname" type="text" required>
</div> <div class="form-group col-md-4">
  <label for ="lastname">Last name:</label>
<input name="lastname" class="form-control" id="lastname" type="text" required>
</div></div>

<div class="form-row">
<div class = "form-group col-md-4">
<label for ="position">Position:</label>
<input name="position" class="form-control" id="position" type="text" required>
</div>
<div class="form-group col-md-4">
  <label for ="accountcode">Account:</label>

  <select class="custom-select form-control" name="accountcode" id="accountcode" required>
    <option value="">Select the company</option>


    <?php
    require 'database.php';
    $sql2 = "SELECT DISTINCT account_code, account_name FROM account ORDER BY account_name ASC;";

    $result2 = $connection->query($sql2);


    $count=0;
    if ($result2->num_rows>0){
      while($row2 = $result2->fetch_assoc()){
      echo "<option value='".$row2['account_code']."'>".$row2['account_name'].'</option><br>';
    }
    }
    ?>

  </select>



</div> </div>

  <div class="form-row">
        <div class="form-group col-md-4"><label for ="email">E-mail address:</label>
  <input name="email" class="form-control" id="email" type="email" required>
</div> <div class="form-group col-md-4">
    <label for ="phone">Phone:</label>
  <input name="phone" class="form-control" id="phone" type="number" required>
</div></div>
</div>

<input type="submit" class="btn btn-primary" id="button">
<a href="all_people.php" class="btn btn-warning" id="button">Cancel</a>

</form>

</div>
</body>



</html>
