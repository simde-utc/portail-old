<link rel="stylesheet" href="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.css" />
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="http://code.jquery.com/mobile/1.3.1/jquery.mobile-1.3.1.min.js"></script>


<div class="part" >

  <?php include_partial('infojob/topbar') ?>
<div class="container-fluid">
   <div class="row-fluid"style="margin-right:3%;">
      <div class="span6"style=" height:500px;boder:1px grey solid">
     	<div class="well">
	<p>Je souhaite recevoir des offres d'emploi par email. </p>
	<p>Voici mes préférences : </p>
	  <?php include_partial('form', array('form' => $form)) ?>
	  <?php include_partial('form', array('form' => $form2)) ?>
	</div>
	   </div>
   	 </div>
   </div>

</div>
</div>
