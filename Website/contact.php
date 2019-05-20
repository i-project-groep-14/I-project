<?php
      $config = ['pagina' => 'contact'];
      require_once 'aanroepingen/connectie.php';
      include_once 'aanroepingen/header.php';
    ?>
    
    <div class="holy-grail-middle">
    
    <section class="contact-us-section">
    <h3> Contact </h3>
  <div class="row medium-unstack">

      <ul class="contact-us-list">
        <li> <i class='fi-marker' style='font-size:24px'> </i> Arnhem, Ruitberglaan 26, Nederland</li>
        <li> <i class='fi-mail' style='font-size:24px'> </i> EenmaalAndermaal@gmail.com</a></li>
        <li> <i class='fi-telephone' style='font-size:24px'> </i> 06 53467895 </li>
      </ul>
    </div>
    <br>
    <div class="columns contact-us-section-right">
      <h4 class="contact-us-header">Stuur ons een bericht</h4>
      <form class="contact-us-form">
        <input type="text" placeholder="Volledige naam">
        <input type="email" placeholder="Email">
        <textarea name="message" id="" rows="12" placeholder="Type hier uw bericht"></textarea>
        <div class="contact-us-form-actions">
          <input type="submit" class="button" value="Versturen" />
          <div>
            <label for="FileUpload" class="button contact-us-file-button">Voeg bestand toe</label>
            <input type="file" id="FileUpload" class="show-for-sr">
          </div>
        </div>
      </form>
    </div>
</section>
    </div>
    <?php 
      include_once 'aanroepingen/footer.html';
    ?>