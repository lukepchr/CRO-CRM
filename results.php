<!doctype html>
<html lang="en">
<head>

<?php include 'header.php';?>
</head>

<body class="bg-light">

<div id="main" >
  <?php
        include 'top.php';
        require 'database.php';
        ?>

        <div class="alert alert-primary" role="alert">
          <h4 class="alert-heading">Search results for <?php echo $_GET['search']; ?></h4>
        </div>


        <!-- here we go.  -->

        <?php
// search for Companies


  $sql = "SELECT * FROM account WHERE account_name LIKE '%" . $_GET['search'] . "%' ORDER BY account_name ASC;";

  $result = $connection->query($sql);

  if ($result->num_rows>0){
    echo "<div class='container'><h5>Companies</h5>";
    while($row = $result->fetch_assoc()){
      echo
      "<a href='organisation_profile.php?id=".$row['id']."'>".
      $row["account_name"]. "</a> " .
      "<small class='text-muted'> in " . $row["city"] .
" <small><kbd>".$row["account_code"] . "</kbd></small> " ;
      echo " <a href=edit_organisation.php?id=". $row["id"] . ">[edit]</a>";
      echo " <a href=org_changed.php?action=delete&id=".$row["id"].">[delete]</a></small><br>";
    }
    echo "</div>";
  }



// search for people
          $sql = "SELECT * FROM person WHERE CONCAT(first_name, last_name) LIKE '%". $_GET['search']."%' ORDER BY last_name ASC;";

          $result = $connection->query($sql);

          if ($result->num_rows>0){
            echo "<div class='container mt-5'>";
            echo "<h5>People</h5>";
            while($row = $result->fetch_assoc()){
// the exact code from people page.

echo "<div style='display: inline;' id='p".$row['id']."'>". $row["first_name"]. " " . $row["last_name"]."</div>";


$sql = "SELECT account_name FROM account WHERE account_code ='" . $row['account_code']. "';";

$employer = $connection->query($sql)->fetch_object()->account_name;

echo "<small class='text-muted'>";

if ($employer){
echo " from " . $employer;
}
else{
echo " (company missing)";
}

echo "</small> <a href=all_people.php?id=". $row["id"] . "><i class='fas fa-edit'></i></a>".
" <a href=person_changed.php?action=delete&id=".$row["id"]." class='removal'>
<i class='fas fa-trash-alt'></i>
</a><br>";





            }
              echo "</div>";
          }



            $connection->close();

?>

        <!-- okay --->


</div>

</body>
<script> // for deleting people
let locked = true;
$(".removal").click(function(event){

if (locked){
event.preventDefault();

  if(confirm("Are you sure you would like to delete this person? (Ok to remove)")){
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
