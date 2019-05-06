<?php 
$cars = array
(
array("Rubriek1"),
array("Rubriek2"),
array("Rubriek3"),
array("Rubriek5"),
array("Rubriek6"),
array("Rubriek8"),
array("Rubriek9"),
array("Rubriek10"),
array("Rubriek11"),
array("Rubriek12"),
array("Rubriek13"),
array("Rubriek14"),
array("Rubriek15"),
array("Rubriek16"),
array("Rubriek17"),
array("Rubriek18"),
array("Rubriek19"),

);



for ($row = 0; $row < 17; $row++) {
    
    echo "<ul>";
    for ($col = 0; $col < 1; $col++) {
      
      echo '<li id="NavRubriek" class="button">'."<a href=".$cars[$row][$col].">".$cars[$row][$col].'</a>'."</li>";
    }
    echo "</ul>";
  }




?> 



