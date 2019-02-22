


<div id="form_container" class="container">
<h2>Editing <span id="person">a person</span></h2>
<form name = "edit_person" method="POST" action = "person_changed.php?action=edit&id=<?php echo $id; ?>">
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for ="firstname">First name:</label>
<input name="firstname" value="<?php echo $firstname ?>" class="form-control" id="firstname" type="text" required>
</div> <div class="form-group col-md-6">
  <label for ="lastname">Last name:</label>
<input name="lastname" value="<?php echo $lastname ?>" class="form-control" id="lastname" type="text" required>
</div></div>
<div class="form-row">
<div class = "form-group col-md-6">
  <label for ="position">Position:</label>
<input name="position" value="<?php echo $position ?>" class="form-control" id="position" type="text" required>
</div>
<div class = "form-group col-md-6">


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

</div></div>

<div class="form-row">
  <div class = "form-group col">
  <label for ="email">E-mail address:</label>
<input name="email" value="<?php echo $email ?>" class="form-control" id="email" type="email" required>
</div><div class = "form-group col">  <label for ="phone">Phone:</label>
<input name="phone" value="<?php echo $phone ?>" class="form-control" id="phone" type="number" required>
</div></div>
<input type="submit" class="btn btn-primary" id="button">
<a href="all_people.php"<button class="btn btn-warning" id="clear form">Cancel</button></a>




</form>
</div>

<script>
$("document").ready(function(){
  let x = $("#accountcode");
  x.val("<?php echo $accountcode ?>");
})
</script>
