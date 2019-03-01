<div style='display: flex; margin: 10px auto 5px 18px; flex-direction: row; align-items: flex-end;'>
<div><a href=index.php><img src='crow.png' style='width: 150px; margin-right: 10px; margin-bottom: -10px'></a>
</div>
<div><h1>CRO<h1><h6>Customer Relationships Organiser</h6></div>

</div>

<?php
$usr= $_SESSION['user'];
echo "<div class='ml-1'><small><kbd>  Hello world from ".$_SERVER['SERVER_SOFTWARE']."</kbd></small></div>";
if($usr){
echo "<small><kbd class='ml-1'>Logged in as $usr</kbd> <kbd class='ml-1'><a href='login.php?action=bye'> <i class='fas fa-sign-out-alt'></i> log out </a> </kbd></small>";
}
?>

<nav class="mt-1 mb-1 row col-md-6">

    <a class="btn btn-primary ml-1" href="index.php"><i class="far fa-newspaper"></i> News</a>

    <a class="btn btn-primary ml-1" href="all_organisations.php"><i class="fas fa-building"></i> Organisations</a>

    <a class="btn btn-primary ml-1" href="all_people.php"><i class="fas fa-users"></i> People</a>

</ul>
<div class="search-container d-inline-flex col-md-4 ml-1">
  <form action="results.php">
    <input type="text" class="h-100 pl-2" placeholder = "search" name="search" required>
    <button type="submit" <i class="fa fa-search"></i></button>
  </form>
</div>
</nav>
