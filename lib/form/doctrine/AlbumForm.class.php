<?php
/**
 * Album form.
 *
 * @package    simde
 * @subpackage form
 * @author     Loic Picavet - loic.picavet@gmail.com
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class AlbumForm extends BaseAlbumForm
{
       public function configure()
  {
       unset($this['created_at'], $this['updated_at']);
       $this->widgetSchema->setLabel('name', "Nom de l'album");
       $this->widgetSchema->setLabel('location', "Lieu");
      // $this->widgetSchema['asso_id'] = new sfWidgetFormInputHidden();

        $this->embedRelation('Images');
  }
  
    
  public function addNewFields($number){
    $new_occurrences = new BaseForm();

    for($i=0; $i <= $number; $i+=1){
      $occurrence = new Image();
      $occurrence->setAlbum($this->getObject());
      $occurrence_form = new ImageForm($occurrence);

      $new_occurrences->embedForm($i,$occurrence_form);
    }

    $this->embedForm('new', $new_occurrences);
  }
  
  
  public function bind(array $taintedValues = null, array $taintedFiles = null){

    $new_occurrences = new BaseForm();
 if(isset($taintedValues['new'])){ 
    foreach($taintedValues['new'] as $key => $new_occurrence){
      $occurrence = new Image();
      $occurrence->setAlbum($this->getObject());
      $occurrence_form = new ImageForm($occurrence);

      $new_occurrences->embedForm($key,$occurrence_form);
    }
 }

    $this->embedForm('new',$new_occurrences);

    parent::bind($taintedValues, $taintedFiles);
  }
  
}

