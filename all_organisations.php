<?php session_start();
if(!$_SESSION[active]){
  include 'login.php';
  die();
}?>
<!doctype html>
<html lang="en">
<head> <?php include 'header.php' ?> </head>
<body class="bg-light">
  <?php include "top.php";
        require 'database.php';
        ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading">Contacts book</h4>
  <p>All organisations</p>
</div>
<div id="main" class="container row">

<div id="leftscreen" class="col">


<div id="form_container" class="container">

  <?php


  $sql = "SELECT * FROM account ORDER BY account_name ASC";

  $result = $connection->query($sql);

  if ($result->num_rows>0){
    while($row = $result->fetch_assoc()){
      echo
      "<a href='organisation_profile.php?id=".$row['id']."'>".
      $row["account_name"]. "</a> " .
      "<small class='text-muted'> in " . $row["city"] .
" <small><kbd>".$row["account_code"] . "</kbd></small> " ;
      echo " </small> <a href=all_organisations.php?id=". $row["id"] . "><i class='fas fa-edit'></i></a>";
      echo " <a href=org_changed.php?action=delete&id=".$row["id"]." class='removal'><i class='fas fa-trash-alt'></i></a></small><br>";
    }
  }
  else {
    echo "zero results.";
  }


    $connection->close();


  ?>
<a href="add_organisation.php"><button class="btn btn-primary mt-2">Add a new organisation</button></a>
</div>

</div>

<div class="col" id="rightscreen">


<?php
if ($_GET['id']){
  include 'edit_organisation.php';
}
else{
  include 'add_organisation.php';
}
?>

</div>

</div>

</body>


<script><!-- pop the org name into the <span> tag in the headline. -->

  let span = document.getElementById("organisation");
  span.innerHTML= "<?php echo $accountname; ?>";
  </script>

</script>

<script> // for deleting people
let locked = true;
$(".removal").click(function(event){

if (locked){
event.preventDefault();

  if(confirm("Are you sure you would like to delete this organisation? (Ok to remove)")){
    locked = false;
    $(this).unbind('click').click();
    $(this)[0].click();
  }
  else {
    locked = true;
  }
}
});
</script>


</html>
