<?php session_start();?>
<!doctype html>
<html lang="en">
<head>

<?php include 'header.php';?>
</head>
<body class="bg-light">


<?php

if(isset($_GET['success'])){
$success = $_GET['success'];
}
if(isset($_GET['note'])){
$note = $_GET['note'];
}

if(isset($note)){
  if($success) echo "<div class='alert-success' id='overlay'>Success, a message was $note. </div>";
  else echo "<div class='alert-warning' id='overlay'>Error! Message not $note!</div>";
}
?>
<!---->
<div id="main">
<?php include "top.php";
include 'database.php'; ?>
<div class="alert alert-primary" role="alert">
  <h4 class="alert-heading"><span id="org">Selected</span> <small>News & organisation profile</small></h4>
  <p></p>
</div>

<div id="form_container" class="row">
      <div id="details" class="col-md-2 ml-5" style="overflow-wrap: break-word; text-align: justify; margin-right: 10px;">
      <h3>Details</h3>

        <?php

        $id = $connection->real_escape_string($_GET["id"]);
        $sql = "SELECT * FROM account WHERE id = '$id'";
        $result = $connection->query($sql);
        $name; $keepcode; $keepid;
        if ($result->num_rows>0){
        $row = $result->fetch_assoc();


      $keepcode = $row['account_code'];
      $name = $row['account_name'];
      $keepid=$row['id'];
      echo "<code>". $keepcode . "</code><br><b>";
      echo $name . "</b><br>";
      echo $row['address'] . "<br>";
      echo $row['city'] . ", ";
      echo $row['postcode'] . "<br><hr>";
      echo '<div class="container mb-2"><i class="fas fa-globe-europe"></i> '.$row['website'] . "<br>";
      echo '<i class="fas fa-phone"></i> '.$row['phone'] . "<br></div>";
      echo "<a href='all_organisations?id=".$row['id']."' class='btn btn-block btn-secondary my-2 my-sm-0'>
      <i class='fas fa-pencil-alt'></i> Edit</a>";
          }
          else {
            echo "error retrieving this result!";
          }


      ?>
    </div>

    <div id="employees" class="col-md-3">
<h3>Employees</h3>
<?php

$sql = "SELECT * FROM person WHERE account_code = '$keepcode'";

$resultpeople = $connection->query($sql);

if ($resultpeople->num_rows>0){
  while($row = $resultpeople->fetch_assoc()){
    echo "<div style='margin-bottom: 10px'>";
    echo $row["first_name"]." ";
    echo $row["last_name"]. " (" . $row["position"] . "),<br><small><i>e-mail:</i> " . $row['email'] ." <i>phone:</i> " . $row['phone']. "</small>";
    echo " <small><a href='all_people.php?id=" . $row["id"] . "'><i class='fas fa-pencil-alt'></i></a></small>";
    echo "</div>";
  }
}
else {
  echo 'No records yet. <a href="all_people.php" class="btn btn-secondary mt-2 btn-block"><i class="fas fa-male"></i> Add a new person...</a>';
}
?> </div>


  <div id="allposts"  class="col-md-4">


<div id="shoutbox" class="container">
    <form id="newpost" action='index.php?<?php echo"
    return=$keepid&account_code=$keepcode"?>' method="POST">
    <h3>News feed</h3><div id="textbox" class="clearfix"><textarea rows="5"
      class="w-100" name="post" placeholder="Write a note here" required></textarea>
    <button type="submit" class="btn btn-primary mt-1 mb-3" value="Send">
      <i class="fas fa-paper-plane"></i> Send</button></div>
    </form>
</div>



  <div id="renderposts" class="container">
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

        echo '<div class ="card border-dark mb-3"
        style="box-shadow: 4px 4px 4px 2px rgba(0,0,0,0.15);">'.
        '<div class="card-header">'."<small class='text-muted'><i>";

        if($row2['account_name'] <> ""){
          echo "Note posted on ";
        }
        echo $row["time_created"]. "</i></div></small>
        <div 'card-body text-dark'>

        <p class='card-text'
          style='margin: 10px 20px'>".$row["memo"]."</p>" .
        '<a href="index.php?action=delete&id='.$row["id"].'">
        <button type="button" class="close" aria-label="Delete"
          style="position: absolute; top:-1px; right: 3px; outline: none">
        <span aria-hidden="true">&times;</span>
          </button> </a>'.
        "</div></div></small>";

      }
  }



  // And that's done


      $connection->close();


    ?> </div></div>
  </div>




<!-- pop the organisation name into the <span> tag in the headline. -->
  <script>
  let span = document.getElementById("org");
  span.innerHTML= "<?php echo $name; ?>";
  </script>



</div>
</body>


</html>
