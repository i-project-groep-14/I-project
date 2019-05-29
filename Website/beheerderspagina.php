    <?php
      $config = ['pagina' => 'beheerderspagina'];

      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>
    
    <div class="holy-grail-middle">
      <h3 class="InlogpaginaKopje"> Beheerders Pagina </h3>
      <br>
      <h4> Rubrieken Toevoegen </h4>

      <h5> Nieuwe Rubriek maken </h5>
      <label> Rubriek naam: </label>
      <input type="text">
      <label> Subrubrieken: </label>
      <input type="text">
      <br>
      <h4> Gebruiker blokeren</h4>

      <input type="text" id="myInput" onkeyup="zoekFunctie()" placeholder="Zoeken op gebruikersnaam...">

      <table id="myTable">
        <tr class="header">
          <th style="width:60%;">Gebruikersnaam</th>
          <th style="width:40%;">Gebruiker blokkeren</th>
        </tr>
            <?php
              $plek = 0;
              $aantalGebruikers = selectAantalGebruikers();
          
              for($i = 0; $i < $aantalGebruikers; $i++) {
                $plek = createGebruikers($plek);
              }
            ?>
      </table>
    </div>

    <?php 
      include_once 'aanroepingen/footer.html';
    ?>

<script>
function zoekFunctie() {
  // Declare variables 
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
