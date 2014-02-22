<div class="part" >
  <?php include_partial('infojob/topbar') ?>

  <div id="infojob-filtrer">
    <a data-toggle="collapse" data-target="#infojob-collapse-filter" id="infojob-collapse-link">
      <h1><i class="<?php if($isGet): ?>icon-chevron-right icon-white<?php else: ?>icon-chevron-down<?php endif; ?>"></i> Filtrer les offres</h1> 
    </a>
    <div id="infojob-collapse-filter"  class="collapse <?php if($isGet): ?>off<?php else: ?>in<?php endif; ?>">
      <form class="infojob-form well" method="post" action="#infojob-annonces">
        <table>
          <tfoot>
            <tr>
              <th></th>
              <td>
                <input type="submit" value="Rechercher" class="btn btn-primary" />
                <input type="reset" value="Réinitialiser" class="btn" style="float:right;" />
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
  
  <h1 id="infojob-annonces"><?php if($isGet): ?>Dernières offres postées. Vous pouvez trier les offres <a id="link-show-filters" href="#infojob-filtrer">en faisant une recherche</a><?php else: ?>Offres<?php endif; ?></h1>
  <?php if(!count($annonces)): ?>
    <p>Aucun résultat</p>
  <?php endif; ?>
  <?php foreach($annonces as $annonce): ?>
  <div class="well">
    <?php if($sf_user->isAuthenticated() && $annonce->getUserId() == $sf_user->getGuardUser()->getId()): ?>
      <a href="<?php echo url_for('infojob/edit?key=' . $annonce->getEmailkey()) ?>"  style="float:right;margin-top:12px; margin-right: 5px;"><i class="icon-pencil"></i></a>
    <?php endif ?>
    <div class="row-fluid">
      <div class="span1">
        <?php 
        // TODO Faire un helper.
        $file = '/images/icones/' . $annonce->getCategorieId() . '.png';
        if(!file_exists(sfConfig::get('sf_root_dir') . '/web' . $file))
          $file = "/images/icones/autre.png";
        ?>
        <img src="<?php echo $file; ?>" style="witdh:30px; height:30px">
      </div>
      <div class="span10">
        <h2>Annonce n°<?php echo $annonce->getId() ?> : <?php echo $annonce->getTitre() ?></h2>
      </div>
    </div>

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
    <p><?php use_helper('Text'); echo truncate_text($annonce->getTexte(), 250, ' <a href="' . url_for('infojob/show?id=' . $annonce->getId()). '">(...)</a>'); ?></p>
    <p>
      <?php if($annonce->getRemuneration()): ?><strong>Rémunération</strong> : <?php echo $annonce->getRemuneration() ?><br /><?php endif ?>
      <?php if($annonce->getLieu()): ?><strong>Lieu :</strong> <?php echo $annonce->getLieu() ?><br /><?php endif ?>
    </p>
    <a href="<?php echo url_for('infojob/show?id=' . $annonce->getId()) ?>" class="btn btn-info" style="color: #FFFFFF;">Voir la fiche</a>
  </div>
  <?php endforeach; ?>
  <?php if ($pager->haveToPaginate()): ?>
  <div class="pagination" style="text-align: center;">
    <a href="<?php echo url_for('infojob/offres', $annonces) ?>?page=<?php echo $pager->getFirstPage() ?>">Premier</a>
    <a href="<?php echo url_for('infojob/offres', $annonces) ?>?page=<?php echo $pager->getPreviousPage() ?>">Précédent</a>
 
    <?php foreach ($pager->getLinks() as $page): ?>
      <?php if ($page == $pager->getPage()): ?>
        <?php echo $page ?>
      <?php else: ?>
        <a href="<?php echo url_for('infojob/offres', $annonces) ?>?page=<?php echo $page ?>"><?php echo $page ?></a>
      <?php endif; ?>
    <?php endforeach; ?>
 
    <a href="<?php echo url_for('infojob/offres', $annonces) ?>?page=<?php echo $pager->getNextPage() ?>">Suivant</a>
    <a href="<?php echo url_for('infojob/offres', $annonces) ?>?page=<?php echo $pager->getLastPage() ?>">Dernier</a>
  </div>
  <?php endif; ?>
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
  $('#link-show-filters').click(function() {
    if($('#infojob-filtrer').find(".icon-chevron-right").hasClass('icon-chevron-right'))
      $("#infojob-collapse-filter").collapse('show');
    return false;
  });
});
</script>

