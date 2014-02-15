<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form id="vraiForm" action="<?php echo url_for('photo/create') ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'photo/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form['galeriePhoto_id'] ?>
      <?php echo $form['author'] ?>
    </tbody>
  </table>
</form>


<?php echo $form['is_public']->renderError() ?>
<label class="checkbox"> 
  Photos publiques (visibles sans connexion)
  <?php echo $form['is_public'] ?>
</label>
<div id="fine-uploader"></div>
<div>
  <a class="btn btn-primary fa-chevron-circle-left fa fa-white fa-1g"
      href="<?php echo url_for('galerie/show?id='.$form['galeriePhoto_id']->getValue()) ?>">
  Retour vers la galerie
  </a>
</div>

<script type="text/javascript">
$(function(){
  $("#fine-uploader").fineUploader({
    debug: true,
    thumbnails:{
      placeholders:{
        waitingPath : "<?php echo public_path('img/upload_grey_square.jpg') ?>"
      }
    },
    request: {
        endpoint: "<?php echo url_for("photo_create_format",array('sf_format'=>'json')) ?>",
        params: {
          'photo[galeriePhoto_id]': $("#photo_galeriePhoto_id").val(),
          'photo[author]': $("#photo_author").val(),
          'photo[is_public]': $("#photo_is_public").attr("checked") ? 1 : 0
        },
        inputName: 'photo[image]'
    },
    failedUploadTextDisplay: {
        mode: 'custom'
    }
  });
  $("#vraiForm").hide();

  $("#photo_is_public").change(function(){
    $("#fine-uploader").fineUploader('setParams', {
      'photo[galeriePhoto_id]': $("#photo_galeriePhoto_id").val(),
      'photo[author]': $("#photo_author").val(),
      'photo[is_public]': $(this).attr("checked") ? 1 : 0
    });
  });
});
</script>

<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader">
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span>Déposer les fichiers pour les importer</span>
        </div>
       
        </br>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>En cours de traitement des fichiers déposés</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <div class="qq-upload-drop-area-selector well" style="min-height:100px;" >
          <h3 class="text-center">Déposez les photos ici pour les ajouter à la galerie</h3>
          <p class="text-center">
          Ou bien 
          <i class="fa fa-folder-open-o fa-white fa-1g qq-upload-button-selector btn">
          sélectionnez
          </i>
          les fichiers a envoyer sur votre disque dur.           
          </p>
          
          <ul class="qq-upload-list-selector qq-upload-list">
            <li class="well">
              <div class="qq-progress-bar-container-selector">
                  <div class="qq-progress-bar-selector qq-progress-bar"></div>
              </div>
              <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
              <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale />
              <span class="qq-upload-file-selector qq-upload-file"></span>
              <span class="qq-upload-size-selector qq-upload-size"></span>
              <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Annuler</a>
              <a class="qq-upload-retry-selector qq-upload-retry" href="#">Réessayer</a>
              <a class="qq-upload-delete-selector qq-upload-delete" href="#">Supprimer</a>
              <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
          </ul>
        </div>
    </div>
</script>
