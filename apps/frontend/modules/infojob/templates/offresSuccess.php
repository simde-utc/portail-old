<div class="part" >
  <?php include_partial('infojob/topbar') ?>

  <div id="infojob-filtrer">
    <a data-toggle="collapse" data-target="#infojob-collapse-filter" id="infojob-collapse-link">
      <h1><i class="icon-chevron-down"></i> Filtrer les offres</h1> 
    </a>
    <div id="infojob-collapse-filter"  class="collapse in">
      <form class="infojob-form well" method="post" action="#infojob-annonces">
        <table>
          <tfoot>
            <tr>
              <th></th>
              <td>
                <input type="submit" value="Rechercher" class="btn btn-primary" />
              </td>
            </tr>
          </tfoot>
          <tbody>
          <?php foreach($filters as $row): ?>
            <tr>
              <th><?php if(!$row->isHidden()) { echo $row->renderLabel(); }; ?></th>
              <td><?php echo $row->render(); ?></td>
            </tr>
          <?php endforeach ?>
          </tbody>
        </table>
      </form>
    </div>
  </div>
  
  <h1 id="infojob-annonces"><?php if($isGet): ?>Dernières offres postées. Pour voir plus d'offres, <a href="#infojob-filtrer">faites une recherche</a><?php else: ?>Offres<?php endif; ?></h1>
  <?php if(!count($annonces)): ?>
    <p>Aucun résultat</p>
  <?php endif; ?>
  <?php foreach($annonces as $annonce): ?>
  <div class="well">
    <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
      <a href="<?php echo url_for('annonce/edit?id=' . $annonce->getEmailkey()) ?>"  style="float:left;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
    <?php endif ?>
    <h2>Annonce n°<?php echo $annonce->getId() ?> : <?php echo $annonce->getTitre() ?></h2>
    <p style="font-style: italic;">
      Posté le <?php echo $annonce->getCreatedAt() ?>
      <?php if($sf_user->isAuthenticated()): ?>
        par : <?php if($annonce->getUserId() != NULL): ?>
          <a href="mailto:<?php echo $annonce->getUser()->getEmailAddress() ?>"><?php echo $annonce->getUser()->getName(); ?></a>
          <?php
        else: echo $annonce->getEmail();
        endif;
        ?>
      <?php endif; ?>
    </p>
    <p><?php echo $annonce->getTexte() ?></p>
    <p>
      <?php if($annonce->getRemuneration() != '0.00'): ?><strong>Prix</strong> : <?php echo $annonce->getRemuneration() ?>€<br /><?php endif ?>
      <?php if($annonce->getLieu()): ?><strong>Lieu :</strong> <?php echo $annonce->getLieu() ?><br /><?php endif ?>
    </p>
    <a href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>" class="btn btn-info" style="color: #FFFFFF;">Voir la fiche</a>
  </div>
  <?php endforeach; ?>
</div>

<script>
$(document).ready(function() {
  $("#infojob-collapse-filter").collapse({
    toggle: false
  }).on('show',function () {
        $('#infojob-filtrer').find(".icon-chevron-right").removeClass("icon-chevron-right icon-white").addClass("icon-chevron-down");
  }).on('hide', function () {
        $('#infojob-filtrer').find(".icon-chevron-down").removeClass("icon-chevron-down").addClass("icon-chevron-right icon-white");
  });
});
</script>

