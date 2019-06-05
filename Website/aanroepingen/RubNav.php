<div class="RubNav row">
  <ul class="multilevel-accordion-menu vertical menu" id="menuRubriek" data-accordion-menu>
    
    <?php
    /*  $rubriekenplek = 0;
      $sql = "SELECT COUNT(*) as aantalHoofdRubrieken FROM rubriek
              WHERE rubriek = 0";
      $query = $dbh->prepare($sql);
      $query -> execute();
      $row = $query -> fetch();

      for($i = 0; $i < $row['aantalHoofdRubrieken']; $i++) {
        $subplek = 0;
        $rubriekenplek = createRubriek($rubriekenplek);
      }*/

      $sql = "SELECT * FROM rubriek WHERE rubriek = 0"; 
      $query = $dbh->prepare($sql);
      $query -> execute();

      while($row = $query -> fetch()){  
        echo"<a id=$row[rubrieknummer] class='addressClick fi-folder-add'>$row[rubrieknaam]</a>";
        echo"<div class='1-rub' id='sub-rubriek-nav-$row[rubrieknummer]'></div>";
      }

    ?>


  </ul>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
var klik = 0;
$(".addressClick").click(function () {
  klik++;
        var addressValue = $(this).attr("id");
        //alert(addressValue);
        
        if(klik > 1){
          //alert(klik);
          //$("div").remove("sub-rubriek-nav-"+addressValue);
          $(".1-rub").empty();
          klik=0;
        }else{
          getSubRubriek(addressValue);
        }
    });

    function getSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "<ul class='menu vertical sublevel-1'>";
            var icon = "fi-folder-add";

            for(var a = 0; a < data.length; a++){
                html += "<li><a class='addressClick2 "+icon+"' id="+data[a].rubrieknummer+">"+ data[a].rubrieknaam +"</a></li>";
                html += "<div class='2-rub' id='sub-rubriek-nav-2-"+data[a].rubrieknummer+"' ></div>";
            }
            html += "</ul>";
          
            document.getElementById("sub-rubriek-nav-" + rubrieknummer).innerHTML = html;
        }

    };
}
klik2=0;
$("#menuRubriek").on("click", ".addressClick2", function() {//Op dit moment moet je dus 2x klikken voordat hij het laat zien
   
      var addressValue = $(this).attr("id");
        klik2++;
        if(klik2 > 1){
          //$("sub-rubriek-nav-2-"+addressValue).remove(".adressClick2");
          $(".2-rub").empty();
          klik2=0;
        }else{
          getSubSubRubriek(addressValue);
        }
        
  
    

});

function getSubSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "<ul class='menu vertical sublevel-2'>";
            var icon = "fi-folder-add";
            for(var a = 0; a < data.length; a++){
                /*if(data[a].rubriekAantal == 0){
                  icon = "fi-page";
                }*/
                html += "<li><a class='addressClick3 "+icon+"' id="+data[a].rubrieknummer+">"+ data[a].rubrieknaam +"</a></li>";
                html += "<div class='3-rub' id='sub-rubriek-nav-3-"+data[a].rubrieknummer+"' ></div>";
            }
            html += "</ul>";
            //alert(html);
            document.getElementById("sub-rubriek-nav-2-" + rubrieknummer).innerHTML = html;
        }

    };
}

var klik3 = 0;
$("#menuRubriek").on("click", ".addressClick3", function() {//Op dit moment moet je dus 2x klikken voordat hij het laat zien
        var addressValue = $(this).attr("id");
        klik3++;
        //alert(addressValue);
        if(klik3 > 1){
          $(".3-rub").empty();
          klik3 = 0;
        }else{
          getSubSubSubRubriek(addressValue);
        }

});

function getSubSubSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "<ul class='menu vertical sublevel-3'>";
            var icon = "fi-folder-add";
            for(var a = 0; a < data.length; a++){
                /*if(data[a].rubriekAantal == 0){
                  icon = "fi-page";
                }*/
                html += "<li><a class='addressClick4 "+icon+"' id="+data[a].rubrieknummer+">"+ data[a].rubrieknaam +"</a></li>";
                html += "<div class='4-rub' id='sub-rubriek-nav-4-"+data[a].rubrieknummer+"' ></div>";
            }
            html += "</ul>";
            //alert(html);
            document.getElementById("sub-rubriek-nav-3-" + rubrieknummer).innerHTML = html;
        }

    };
}

var klik4 = 0;
$("#menuRubriek").on("click", ".addressClick4", function() {//Op dit moment moet je dus 2x klikken voordat hij het laat zien
        var addressValue = $(this).attr("id");
        if(klik4 > 1){
          klik4++;
          klik4 = 0;
          $(".4-rub").empty();
        }else{
          getSubSubSubSubRubriek(addressValue);
        }
        

});
    
function getSubSubSubSubRubriek(rubrieknummer){
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "get-rubrieken.php?rubrieknummer=" + rubrieknummer, true);
    ajax.send();

    ajax.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            var data = JSON.parse(this.responseText);
            var html = "<ul class='menu vertical sublevel-4'>";
            var icon = "fi-folder-add";
            for(var a = 0; a < data.length; a++){
                /*if(data[a].rubriekAantal == 0){
                  icon = "fi-page";
                }*/
                html += "<li><a class='addressClick5 "+icon+"' id="+data[a].rubrieknummer+">"+ data[a].rubrieknaam +"</a></li>";
                html += "<div id='sub-rubriek-nav-5-"+data[a].rubrieknummer+"' ></div>";
            }
            html += "</ul>";
            //alert(html);
            document.getElementById("sub-rubriek-nav-4-" + rubrieknummer).innerHTML = html;
        }

    };
}


</script>
