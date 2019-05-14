<?php
      echo"
      <div class='body-tekst' >
            <ol class='progress-indicator'>
                  <li class=";
                        if ($config['pagina'] == 'registratie_email') {
                              echo"'is-current'";
                        } else {
                              echo "is-complete";
                        }
                        echo "
                        data-step=''>
                        <span>Verifiëren e-mail</span>
                  </li>
                  <li class=";
                        if($config['pagina'] == 'registratie_persoonsgegevens') {
                              echo"'is-current'";
                        } else if ($config['pagina'] == 'registratie_email') {
                              echo "''";
                        } else {
                              echo "is-complete";
                        }
                        echo "
                        data-step=''>
                        <span>Gegevens invullen</span>
                  </li>
                  <li class=";
                        if($config['pagina'] == 'registratie_vraag') {
                              echo"'is-current'";
                        } else if ($config['pagina'] == 'registratie_email' || $config['pagina'] == 'registratie_persoonsgegevens'){
                              echo"''";
                        } else {
                              echo "is-complete";
                        }
                        echo"
                        data-step=''>
                        <span>Veiligheidsvraag</span>
                  </li>
            </ol>
      </div>";

      // <ol class="progress-indicator">
      //   <li class="is-complete" data-step="">
      //     <span>Verifiëren e-mail</span>
      //   </li>
      //   <li class="is-complete" data-step="">
      //     <span>Gegevens invullen</span>
      //   </li>
      //   <li class="is-current" data-step="">
      //     <span>Veiligheid</span>
      //   </li>
      //   <li class="" data-step="">
      //       <span>Klaar</span>
      // </li>
      // </ol>
?>