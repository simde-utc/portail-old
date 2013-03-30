<div class="part">
  <h1>Gestion des mails</h1>
  <?php include_partial('gesmail/liste', array('boxes' => $boxes, 'asso' => $asso, 'box' => $box)) ?>
  <h2><?php echo $box->getEmail() ?></h2>
  <p><?php echo ucfirst($box->getTypeLu()) ?></p>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Adresse mail</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php if($box->getDestinataires()->count() > 0): ?>
        <?php foreach($box->getDestinataires() as $dest): ?>
        <tr>
          <td><?php echo $dest->destination ?></td>
          <td>
            <form action="<?php echo url_for('gesmail_box_delete', array('box' => $box->idbox, 'login' => $asso->getLogin())) ?>" method="post" class="butseul form-inline">
              <input type="hidden" name="email" value="<?php echo $dest->destination ?>" />
              <input type="submit" class="btn" value="Supprimer" />
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      <?php endif; ?>
      <tr>
        <form action="<?php echo url_for('gesmail_box_add', array('box' => $box->idbox, 'login' => $asso->getLogin())) ?>" method="post" class="form-horizontal">
        <td>
          <?php if(!empty($flash['adderror'])): ?>
          <div class="alert alert-error">
            <?php echo $flash['adderror']; ?>
          </div>
          <?php endif; ?>
          <input type="text" name="email" />&nbsp;&nbsp;&nbsp;<input type="submit" class="btn" value="Ajouter &raquo;" />
        </td>
        <td>&nbsp;</td>
        </form>
      </tr>
    </tbody>
  </table>
  <p>Toutes les adresses listées ci-dessus reçoivent les messages envoyés à la liste.</p>
  <?php if(!empty($box->extension)): ?>
  <p><a class="btn btn-danger" onclick="return confirm('Ceci supprimera définitivement cette adresse et tout son contenu. Êtes-vous sur de vouloir poursuivre ?');" href="<?php echo url_for('gesmail_delete', array('login' => $asso->getLogin(), 'id' => $box->idbox)) ?>">Supprimer cette adresse</a></p>
  <?php endif; ?>
</div>