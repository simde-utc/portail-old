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
      <?php echo $form ?>
    </tbody>
  </table>
</form>

<div id="fine-uploader">
</div>

<div>
  <a class="return-gallery-button btn btn-primary" href="<?php echo url_for('galerie/show?id='.$form['galeriePhoto_id']->getValue()) ?>">Retour vers la galerie</a>
</div>

<script type="text/javascript">
$(document).ready(function(){
  $("#fine-uploader").fineUploader({
    debug: true,
    request: {
        endpoint: "<?php echo url_for("photo_create_format",array('sf_format'=>'json')) ?>",
        params: {
          'photo[galeriePhoto_id]': $("#photo_galeriePhoto_id").val(),
          'photo[author]': $("#photo_author").val(),
          'photo[is_public]': $("#photo_is_public").val()
        },
        inputName: 'photo[image]'
    },
    failedUploadTextDisplay: {
        mode: 'custom'
    }
  });
  $("#vraiForm").hide();
});
</script>

<script type="text/template" id="qq-template">
    <div class="qq-uploader-selector qq-uploader">
        <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
            <span>Drop files here to upload</span>
        </div>
        <div class="qq-upload-button-selector qq-upload-button">
            <div>Upload a file</div>
        </div>
        <span class="qq-drop-processing-selector qq-drop-processing">
            <span>Processing dropped files...</span>
            <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
        </span>
        <ul class="qq-upload-list-selector qq-upload-list">
            <li>
              <div class="qq-progress-bar-container-selector">
                  <div class="qq-progress-bar-selector qq-progress-bar"></div>
              </div>
              <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
              <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
              <span class="qq-upload-file-selector qq-upload-file"></span>
              <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
              <span class="qq-upload-size-selector qq-upload-size"></span>
              <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Cancel</a>
              <a class="qq-upload-retry-selector qq-upload-retry" href="#">Retry</a>
              <a class="qq-upload-delete-selector qq-upload-delete" href="#">Delete</a>
              <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
            </li>
        </ul>
    </div>
</script>
