<div id="contact">
  <p>Contacter <?php echo $asso->getName() ?></p>
  <p>Rue Roger Couttolenc<br />
    60200 Compiègne</p>
  <?php if ($asso->getPhone()): ?>
    <p>
      Tél. : <?php echo $asso->getPhone() ?>
    </p>
  <?php endif ?>
  <?php if ($asso->getSalle()): ?>
    <p>
      Salle : <?php echo $asso->getSalle() ?>
    </p>
  <?php endif ?>
  <p>
    <a class="ejs"><?php echo $asso->getLogin() ?></a><br />
    <a href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
      <?php if ($asso->getFacebook()): ?>
      <a href="<?php echo $asso->getFacebook() ?>">facebook</a>
  <?php endif ?>
  </p>
</div>
