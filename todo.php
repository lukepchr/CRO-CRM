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


<div class='card'>

<ul>

  <?php

  //hardwired for the time being but this will be requested from mysqli.
  $tasks =array(
    'get something done',
    'do another thing',
    'call Michael regarding Jackson'
  );

  foreach ($tasks as $task){
      echo "<li><input type='checkbox'/> $task </li>";
  }
  ?>

</ul>
</div>
