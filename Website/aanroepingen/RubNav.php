<?php 
$cars = array
(
array("Rubriek1",),
array("Rubriek2"),
array("Rubriek3"),
array("Rubriek4"),
array("Rubriek5"),
array("Rubriek6"),
array("Rubriek7"),
array("Rubriek8"),
array("Rubriek9"),
array("Rubriek10"),

);



for ($row = 0; $row < 10; $row++) {
    
    echo "<ul class='RubriekNav'>";
    for ($col = 0; $col < 1; $col++) {
      
      echo '<li id="NavRubriek" class="button">'."<a href=".$cars[$row][$col].">".$cars[$row][$col].'</a>'."</li>";
    }
    echo "</ul>";
  }




?> 



