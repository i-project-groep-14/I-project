<?php 
$cars = array
(
array("Antiek en Kunst",),
array("Audio , Tv en Foto"),
array("Auto's"),
array("Auto-onderdelen"),
array("Auto diversen"),
array("Boeken"),
array("Muziek en Instrumenten"),
array("Sport en Fitness"),
array("Watersport en Boten"),
array("Diversen"),

);



for ($row = 0; $row < 10; $row++) {
    
    echo "<ul class='RubriekNav'>";
    for ($col = 0; $col < 1; $col++) {
      
      echo '<li id="NavRubriek" class="button">'.$cars[$row][$col]."</li>";
    }
    echo "</ul>";
  }




?> 



