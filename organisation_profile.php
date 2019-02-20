<!doctype html>
<html lang="en">
<head>

<?php include 'header.php';?>
</head>
<body>


<?php
$success = $_GET['success'];
$note = $_GET['note'];

if($note){
  if($success) echo "<div class='alert-success'>Success, a message was $note. </div>";
  else echo "<div class='alert-warning'>Error! Message not $note!</div>";
}
?>
<!---->
<div id="main" class="bg-light">
<?php include "top.php";
include 'database.php'; ?>
<div class="alert alert-info" role="alert">
  <h4 class="alert-heading"><span id="org">Selected</span> <small>News & organisation profile</small></h4>
  <p></p>
</div>

<div id="form_container" class="d-flex flex-nowrap ml-5 ">
      <div id="details" class="col-md-2" style="overflow-wrap: break-word; text-align: justify; margin-right: 10px;">
      <h3>Details</h3>


        <?php

        $id = $_GET["id"];
        $sql = "SELECT * FROM account WHERE id = '$id'";
        $result = $connection->query($sql);
        $name; $keepcode; $keepid;
        if ($result->num_rows>0){
        $row = $result->fetch_assoc();


      $keepcode = $row[account_code];
      $name = $row[account_name];
      $keepid=$row[id];
      echo "<code>". $keepcode . "</code><br><b>";
      echo $name . "</b><br>";
      echo $row[address] . "<br>";
      echo $row[city] . "<br>";
      echo $row[postcode] . "<br>";
      echo $row[website] . "<br>";
      echo $row[phone] . "<br>";

      echo "<a href='edit_organisation?id=".$row[id]."' class='btn btn-outline-success my-2 my-sm-0'>
      Edit</a>";
          }
          else {
            echo "error retrieving this result!";
          }


      ?>
    </div>


  <div id="allposts"  class="flex-row flex-nowrap align-flex-start">

<div id="flex" class="d-flex flex-nowrap col-md-3" >
    <div id="employees" class="container">
<h3>Employees</h3>
<?php

$sql = "SELECT * FROM person WHERE account_code = '$keepcode'";

$resultpeople = $connection->query($sql);

if ($resultpeople->num_rows>0){
  while($row = $resultpeople->fetch_assoc()){
    echo "<div style='margin-bottom: 10px'>";
    echo $row["first_name"]." ";
    echo $row["last_name"]. " (" . $row["position"] . "),<br><small><i>e-mail:</i> " . $row['email'] ." <i>phone:</i> " . $row['phone']. "</small>";
    echo " <small><a href='edit_person.php?id=" . $row["id"] . "'>[edit]</a></small>";
    echo "</div>";
  }
}
else {
  echo "zero results.";
}
?> </div>

<div id="shoutbox" class="ml-5 mb-4">
    <form id="newpost" action='index.php?<?php echo"
    return=$keepid&account_code=$keepcode"?>' method="POST"><h3>News feed</h3>
    <div id="textbox"><textarea rows="5" cols="50" name="post" placeholder="Write a note here"></textarea><br>
    <input type="submit" class="btn btn-outline-success my-2 my-sm-0" style="display: inline; align: right;" value="Send"></div></form></div>

  </div>

  <div id="allposts" class="container ml-5 mb-4 col-md-5">
  <!--end of shoutbox
  // Render all the posts regarding this place.-->
  <?php
  $sql = "SELECT * FROM posts WHERE account_code = '$keepcode' ORDER BY id DESC;";

    $result = $connection->query($sql);

    if ($result->num_rows>0){
      while($row = $result->fetch_assoc()){
        $acc= $row['account_code'];
        $subsql = "SELECT * FROM account WHERE account_code = '$acc';";
        $subresult = $connection->query($subsql);
        $row2 = $subresult->fetch_assoc();

        echo '<div style="border: 1px solid #999; padding: 20px; text-align: justify; position: relative; margin: 10px auto; box-shadow: 4px 4px 4px 2px rgba(0,0,0,0.15);">';
        echo "<small class='text-muted' style='position: absolute; top: 2px; left:5px;'><i>";

        echo $row["time_created"]. "</i></small><p style='margin: 10px 20px'>".$row["memo"]."</p>" .
        '<small><p class="text-muted" style="position: absolute; top:2px; right: 2px;"><a href="index.php?return='.$row2["id"].'&action=delete&id='.$row['id'].'">[x]</a></p></small>'  ;
        echo "</div>";}
  }



  // And that's done


      $connection->close();


    ?> </div></div></div>




<!-- pop the organisation name into the <span> tag in the headline. -->
  <script>
  let span = document.getElementById("org");
  span.innerHTML= "<?php echo $name; ?>";
  </script>



</div>
</body>


</html>
