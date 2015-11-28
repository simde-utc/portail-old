<?php

/**
 * Document form.
 *
 * @package    simde
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class DocumentForm extends BaseDocumentForm
{
  public $path = null;

  public function configure()
  {
    $this->widgetSchema['fichier'] = new sfWidgetFormInputFile(array(), array('accept'=>'application/pdf'));
    $this->validatorSchema['fichier'] = new sfValidatorPass();//portailValidatorFileNotNull();

    unset($this['created_at'], $this['updated_at'], $this['auteur']);

    $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['transaction_id'] = new sfWidgetFormInputHidden();
  }

  public function setFilePath($path) {
    $this->path = $path;
  }

  public function updateFichierColumn($value) {
    /* On veut stocker le fichier dans data/<login-asso>/documents/<type-document>
     * Avec un nom en fonction de la date et de la transaction liée
     */
    // on recupere l'extension
    $name_parts = explode('.', $value['name']);
    $last = count($name_parts) - 1;
    if ($last > 0) { // on a bien une extension
      $extension = '.' . $name_parts[$last];
      unset($name_parts[$last]);
    } else {
      $extension = '';
    }
    $filename = implode('.', $name_parts);

    // nom du fichier
    $fichier = date('Y-m-d-H-i-s') . '-' . Doctrine_Inflector::urlize($filename) . $extension;

    // on rajoute le numero de transaction si on en a un
    $transaction_id = $this->getValue('transaction_id');
    if ($transaction_id != NULL) {
      $fichier = $transaction_id . '-' . $fichier;
    }

    $type_id = $this->getValue('type_id');
    $type = DocumentTypeTable::getInstance()->find($type_id);

    // on déplace le fichier
    $dir = $this->path . $type->getSlug() . '/';
    if(!is_dir($dir)) {
      mkdir($dir, 0770, True);
    }

    move_uploaded_file($value['tmp_name'], $dir . $fichier);

    return $fichier;
  }

  /**
   * the missing set value function to change a default after the values are bound
   * @param string $field the name of the field
   * @param mixed $value the new value
   */
  public function setValue($field, $value) {
      $this->values[$field] = $value; // set the value for this request
      $this->taintedValues[$field] = $value; // override the value entered by the user
      $this->resetFormFields(); // force a refresh on the field schema
  }
}
