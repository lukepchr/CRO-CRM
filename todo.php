<?php require 'header.php' ?>

<style>

body{
  width: 250px;
  padding: 5px;
}
.card{
  background-color: beige;
  font-size: 0.9em;
}
ul{
  list-style-type: none;
  padding: 2px;
}

</style>
This module will be a part of each personal profile in the CRM.

<div class='card form-group'>

<ul>

  <?php

  //hardwired for the time being but this will be requested from mysqli.
  $tasks =array(
    'get something done',
    'do another thing',
    'call Michael regarding Jackson'
  );
  $id = 0;
  foreach ($tasks as $task){
      echo "<li><input id='box$id' class='chkbx' type='checkbox'/> $task </li>";
      $id++;
  }
  ?>

</ul>
<div class='container row w-100'>
<textarea rows="4" class="p-2"></textarea>

<button type="submit"class="btn btn-primary ml-1"><i class="fas fa-paper-plane"></i></button>

</div>
</div>

<script>

$(".chkbx").click(function(){
  let id = event.target.id;
  console.log(`box clicked ${id}`);
});

</script>
