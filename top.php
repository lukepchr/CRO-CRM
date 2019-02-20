<div style='display: flex; margin: 10px auto 5px 18px; flex-direction: row; align-items: flex-end;'>
<div><a href=index.php><img src='crow.png' style='width: 150px; margin-right: 10px; margin-bottom: -10px'></a>
</div>
<div><h1>CRO<h1><h6>Customer Relationships Organiser</h6></div>

</div>

<?php
echo "<small><kbd>  Hello world from ".$_SERVER['SERVER_SOFTWARE']."</kbd></small>";

?>

<nav class="mt-1 mb-1">

        <a class="btn btn-primary" href="index.php"><i class="far fa-newspaper"></i> News</a>

    <a class="btn btn-primary" href="all_organisations.php"><i class="fas fa-building"></i> Organisations</a>
  <a class="btn btn-primary" href="all_people.php"><i class="fas fa-users"></i> People</a>
</ul>
</nav>
<script>
$('#myTab a').on('click', function (e) {
  e.preventDefault()
  $(this).tab('show')
})
</script>
