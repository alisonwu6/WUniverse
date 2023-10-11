<?php 
  // echo 2+2

  // this is function definition
  function myFirstFunction() {
    echo 2 + 2;
  }
  // call
  // myFirstFunction();

  function greet($name, $color) {
    echo "<p>Hi, my name is $name and my favorite color is $color. </p>";
  }

  greet("Alison", "yellow");
  greet("John", "seagreen");
?>

<h1><?php blogInfo("name")?></h1>
<p><?php blogInfo("description")?></p>