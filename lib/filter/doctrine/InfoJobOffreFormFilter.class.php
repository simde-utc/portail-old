<?php

/**
 * InfoJobOffre filter form.
 *
 * @package    simde
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class InfoJobOffreFormFilter extends BaseInfoJobOffreFormFilter
{
  public function configure()
  
  {
  
      
  	 $this->widgetSchema['lieu']->setOption('with_empty', false);
  	 $this->widgetSchema['titre']->setOption('with_empty', false);
  	 $this->widgetSchema['texte']->setOption('with_empty', false);
  	// $this->widgetSchema['disponibilite']->setOption('with_empty', false);

 


         


   /* $this->widgetSchema['tools']  = new sfWidgetFormSelectCheckbox(array(
                                        'choices'   => $dispo,
                                        
                                     ));*/
  	 $this->setDefault('lieu', 'Votre email ici');
  	$this->widgetSchema->setLabels(array(
  'Categorie '   =>' Selectionnez une catégorie',
 'titre'   => ' Saisissez le titre de l annonce',
  'lieu' => 'Avez-vous des préférences géorgraphiques',
  'texte'=>'Saisissez un mot clé'));


   


  	 

  	unset($this['created_at'], $this['updated_at'], $this['expiration_date'], $this['emailkey'], $this['user_id'], $this['archivage_date'],$this['email'], $this['telephone'],$this['remuneration']);
  }
}
