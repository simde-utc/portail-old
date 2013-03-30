<div class="part">
  <h1>Gestion des mails</h1>
  <?php include_partial('gesmail/liste', array('boxes' => $boxes, 'asso' => $asso)) ?>
  
  <form action="<?php echo url_for('gesmail_docreate', array('login' => $asso->getLogin())) ?>" method="post" class="editform well">
    <table>
      <tfoot>
        <tr>
          <th></th>
          <td>
            <?php echo $form->renderHiddenFields(false) ?>
            <input class="btn btn-primary" type="submit" value="Ajouter" />
          </td>
        </tr>
      </tfoot>
      <tbody>
        <?php echo $form ?>
      </tbody>
    </table>
  </form>  
</div>