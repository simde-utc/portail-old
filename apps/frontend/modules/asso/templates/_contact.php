<div id="contact">
  <p>Contacter <?php echo $asso->getName() ?></p>
  <p>Rue Roger Couttolenc<br />
    60200 Compiègne</p>
  <?php if ($asso->getPhone()): ?>
    <p>
      Tél. : <?php echo $asso->getPhone() ?>
    </p>
  <?php endif ?>
  <p>
    <a href="mailto:<?php echo $asso->getLogin() ?>@assos.utc.fr"><?php echo $asso->getLogin() ?>@assos.utc.fr</a><br />
    <a href="<?php echo $asso->getUrlSite() ?>"><?php echo $asso->getUrlSite() ?></a>
  </p>
</div>
