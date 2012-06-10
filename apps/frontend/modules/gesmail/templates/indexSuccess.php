<div class="container-fluid">
  <div class="row-fluid">
    <?php include_partial('gesmail/liste', array('boxes' => $boxes, 'asso' => $asso, 'adr' => $adr)) ?>
    <div class="span8">
      <?php if(!empty($flash['success'])): ?>
        <div class="alert alert-success"><?php echo $flash['success']; ?></div>
        <?php endif; ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Adresse mail</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($destinataires as $dest): ?>
            <tr>
              <td><?php echo $dest['destination']; ?></td>
              <td>
                <form action="delete" method="post" class="butseul form-inline">
                  <input type="hidden" name="_METHOD" value="DELETE" />
                  <input type="submit" class="btn" value="Supprimer" />
                </form>
              </td>
            </tr>
            <?php endforeach; ?>
            <tr>
              <form action="/gesmail/<?php echo $adr; ?>" method="post" class="form-horizontal">
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