<?php
  $sql = "SELECT * FROM rubriek WHERE rubriek = 0 ORDER BY rubrieknummer";
  $query = $dbh->prepare($sql);
  $query -> execute();
?>

<div class="MobielZoekProduct">
  <button class="collapsible">Zoeken</button>
  <div class="content">
    <Br>
    <form action="zoekresultaten.php" method="POST">
      <input type="search" placeholder="Zoek Product..." name="zoekwoord"><br>
      <div class="medium-12 cell">
        <label>Rubriek: </label>
        
        <select id="rubriekk" name="rubriek" onchange="getSubRubriekk(this.value);">
          <option value="-1" selected>Kies een rubriek</option>
          <?php
            while($data = $query -> fetch()) {
              echo"<option value='".$data['rubrieknummer']."'>".$data['rubrieknaam']."</option>";
            }
          ?>
        </select>

        <select id="sub-rubriekk" name="sub-rubriek" onchange="getSubSubRubriekk(this.value);"> 
        </select>

        <select id="sub-sub-rubriekk" name="sub-sub-rubriek" onchange="getSubSubSubRubriekk(this.value);" >
        </select>

        <select id="sub-sub-sub-rubriekk" name="sub-sub-sub-rubriek" >        
        </select>         
      </div>
      <input class="button" type="submit" value="Zoeken" name="zoeken">
    </form>
  </div>
</div>



<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

<script type="text/javascript"> 


function getSubRubriekk(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "";
                
            for(var a = 0; a < data.length; a++){
                html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
            }
            
            document.getElementById("sub-rubriekk").innerHTML = html;
        }

    };

}

function getSubSubRubriekk(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "";//"<option > Kies een subSubRubriek </option>";
                
            for(var a = 0; a < data.length; a++){
                html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
            }
            
            document.getElementById("sub-sub-rubriekk").innerHTML = html;
        }

    };

}

function getSubSubSubRubriekk(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "";//"<option > Kies een subsubSubRubriek </option>";
           
                for(var a = 0; a < data.length; a++){
                 html += "<option value='" + data[a].rubrieknummer + "'>"+ data[a].rubrieknaam +"</option>";
                
            }

            document.getElementById("sub-sub-sub-rubriekk").innerHTML = html;
        }

    };

}

</script>