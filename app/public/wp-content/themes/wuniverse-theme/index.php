<?php 
  $name = array('Alison', 'Renee', 'Michael', 'Bob');

  $count = 0;

  while($count < count($name)) {
    echo "<li>Hi, my name is $name[$count]</li>";
    $count++;
  }
?>