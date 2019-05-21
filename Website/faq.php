<?php
  $config = ['pagina' => 'faq'];
 require_once 'aanroepingen/connectie.php';
 include_once 'aanroepingen/header.php'; 
?>

<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script>
 $(document).ready(function() {
 
    $('.faq_question').click(function() {
 
        if ($(this).parent().is('.open')){
            $(this).closest('.faq').find('.faq_answer_container').animate({'height':'0'},500);
            $(this).closest('.faq').removeClass('open');
 
            }else{
                var newHeight =$(this).closest('.faq').find('.faq_answer').height() +'px';
                $(this).closest('.faq').find('.faq_answer_container').animate({'height':newHeight},500);
                $(this).closest('.faq').addClass('open');
            }
 
    });
 
});
</script>

<div class="holy-grail-middle">
<h3> Veelgestelde Vragen </h3> 
<p> Op zoek naar antwoorden, hieronder staan de meestgestelde vragen. <br> Staat uw vraag er niet tussen? Stel hem dan via onze <a href="contact.php">contactpagina</a>.</p>


<div class="faq_containervak">

<div class="faq_containerLinksBoven"> 
<h3> Gebruiker </h3>
<div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i> Kan ik als gebruiker spullen verkopen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Nee, als gebruiker kun je geen spullen verkopen, hiervoor moet je je aanmelden als verkoper.</div>
           </div>        
    </div>
 </div>
 <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i> Moet ik mij registeren als ik wil bieden?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Ja, je moet een gebruiker zijn op te kunnen bieden.</div>
           </div>        
    </div>
    <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Kan ik als gebruiker zakelijk advertenties plaatsen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">NEIN NEIN NEIN</div>
           </div>        
    </div>
 </div>
</div>

<div class="faq_containerRechtsBoven">
<h3> Verkoper </h3>
<div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Hoe kan ik een verkoper worden?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Door veel te jagen op koopjes</div>
           </div>        
    </div>
 </div>
 <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Hoeveel producten kan ik aanbieden als verkoper?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Er is geen limiet op het aantal aangeboden producten.</div>
           </div>        
    </div>
    <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Kan ik als bedrijf zakelijk advertenties plaatsen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Oja zeker, de hypotheker.</div>
           </div>        
    </div>
 </div>
</div>

<div class="faq_containerLinksOnder"> 
<h3> Algemeen </h3>
<div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Hoe plaats ik een product?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Als u bent ingelogd zal er bij uw profiel staan 'plaats product' mits u een verkoper bent.</div>
           </div>        
    </div>
 </div>
 <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Krijg ik een melding als iemand hoger bied dan ik?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Ja, u zal een melding ontvangen via de mail als iemand hoger bied dan u.</div>
           </div>        
    </div>
 </div>
 <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Welke betaalmethoden kunnen er gebruikt worden?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Er kan gebruik gemaakt worden van: iDeal, Paypal en een Creditcard.</div>
           </div>        
    </div>
 </div>
</div>

<div class="faq_containerRechtsOnder">
<h3> Bedrijven </h3>
<div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Kan ik als bedrijf meerdere producten plaatsen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Dat kan zeker weten, maar de aap moet al uit de schoen zijn.</div>
           </div>        
    </div>
    <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Kan ik als bedrijf zakelijk advertenties plaatsen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Oja zeker, de hypotheker.</div>
           </div>        
    </div>
    <div class="faq_container">
   <div class="faq">
      <div class="faq_question"> <i class='fi-plus' style='font-size:14px'> &nbsp; </i>Kan ik als bedrijf zakelijk advertenties plaatsen?</div>
           <div class="faq_answer_container">
              <div class="faq_answer">Oja zeker, de hypotheker.</div>
           </div>        
    </div>
</div>

</div>
</div>
</div>
</div>
</div>
<?php include_once 'aanroepingen/footer.html' ?>