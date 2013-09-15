<?php

require_once dirname(__FILE__).'/../lib/charte_locauxGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/charte_locauxGeneratorHelper.class.php';

/**
 * charte_locaux actions.
 *
 * @package    simde
 * @subpackage charte_locaux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class charte_locauxActions extends autoCharte_locauxActions
{
  public function executeListRefuser(sfWebRequest $request)
  {
    $charte = $this->getRoute()->getObject();
      if($charte->getStatut() == 3) 
      {
        $this->getUser()->setFlash('error', 'Cette demande d\'accès étendu a déjà été acceptée vous ne pouvez la supprimer si vous souhaitez le faire veuillez contacter un administrateur réseau.');
        $this->redirect('charte_locaux');
      }

    $message = $this->getMailer()->compose(
      array('bde@assos.utc.fr' => 'BDE UTC'),
      $charte->getResponsable()->getEmailAddress(),
      'Refus de votre demande d\'accès étendu au locaux',
      <<<EOF
Bonjour,

Votre demande d'accès étendu du {$charte->getCreatedAt()} pour l'association {$charte->getAsso()->getName()} a été refusée. Merci de prendre contact avec le BDE pour plus d'informations.

Le BDE
EOF
);
    $this->getMailer()->send($message);
    $charte->delete();
    $this->getUser()->setFlash('success', 'Vous avez refusé la demande d\'accès étendu.');
    $this->redirect('charte_locaux');
  }


  public function executeListValider(sfWebRequest $request)
  {
    $charte = $this->getRoute()->getObject();
    if($charte->getStatut() != 2)
    {
      if($charte->getStatut() == 3) $this->getUser()->setFlash('error', 'Cette demande d\'accès étendu a déjà été acceptée.');
      else $this->getUser()->setFlash('error', 'Le président de l\'association n\'a pas accepté cette demande d\'accès étendu.');
      $this->redirect('charte_locaux');
    }
    if($charte->getSemestreId() != sfConfig::get('app_portail_current_semestre'))
    {
      $this->getUser()->setFlash('error', 'La charte date d\'un semestre antérieur vous ne pouvez la valider.');
      $this->redirect('charte_locaux');
    }
    $charte->setStatut(3);
    
    $message = $this->getMailer()->compose(
    array('bde@assos.utc.fr' => 'BDE UTC'),
    $charte->getResponsable()->getEmailAddress(),
    'Refus de votre demande d\'accès étendu au locaux',
    <<<EOF
Bonjour,

Votre demande d'accès étendu du {$charte->getCreatedAt()} pour l'association {$charte->getAsso()->getName()} a été acceptée.

Le BDE
EOF
);
    $this->getMailer()->send($message);
    $charte->save();
    $this->getUser()->setFlash('success', 'Vous avez accepté la demande d\'accès étendu.');
    $this->redirect('charte_locaux'); 
  }
}
