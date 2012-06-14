<div class="container-fluid">
  <div class="row-fluid">
    <?php include_partial('gesmail/liste', array('boxes' => $boxes, 'asso' => $asso, 'box' => $box)) ?>
    <div class="span8">
      <?php if(!empty($flash['success'])): ?>
        <div class="alert alert-success"><?php echo $flash['success']; ?></div>
      <?php endif; ?>
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
              <form action="" method="post" class="form-horizontal">
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
        Toutes les adresses listées ci-dessus reçoivent les messages envoyés à la liste.
    </div>    
  </div>
</div>