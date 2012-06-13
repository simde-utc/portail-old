<div class="part" >
  <h1>Modifier le rôle d'un membre</h1>
  <br />
  <div class="well">
    Membre : <?php echo $asso_member->getUser() ?><br />
    <br />
    <?php include_partial('form', array('form' => $form)) ?>
  </div>
</div>