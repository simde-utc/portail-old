<?php

/**
 * locaux actions.
 *
 * @package    simde
 * @subpackage locaux
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class locauxActions extends sfActions
{
  /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */

  
  public function executeCharte(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    if(!($this->getUser()->isAuthenticated()) || !($this->getUser()->getGuardUser()->isMember($this->asso->getLogin())))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $this->asso->getLogin());	
    }

    $this->form = new CharteLocauxForm();
    $this->form->setDefault('asso_id', $this->asso->getPrimaryKey());
    $this->form->setDefault('user_id', $this->getUser()->getGuardUser()->getId());
    $this->form->setDefault('date', date('Y-m-d H:i:s'));    
   }

  public function executeCreate(sfWebRequest $request) 
  {
    $charte = new CharteLocaux();
    $charte->setStatut(0);
    $charte->setSemestreId(sfConfig::get('app_portail_current_semestre'));
    $charte->setIp($_SERVER['REMOTE_ADDR']);
    $charte->setLogin($this->getUser()->getGuardUser()->getUserName());
    $charte->setUserId($this->getUser()->getGuardUser()->getId());
    $charte->setDate(date('Y-m-d H:i:s'));

    $this->form = new CharteLocauxForm($charte);
    if(!($this->getUser()->isAuthenticated()))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('homepage');
    }
    if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
      $this->processForm($request, $this->form);
    $this->setTemplate('charte');
  }

  public function executeLocauxCtrl(sfWebRequest $request)
  {
    $this->charte = $this->getRoute()->getObject();
    if(!($this->getUser()->isAuthenticated()) || $this->charte->getLogin()!= $this->getUser()->getUserName())
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('homepage');
    }
    if($this->charte->statut !=0)
    {
      $this->getUser()->setFlash('error', 'Cette charte a déjà été signée.');
      $this->redirect('homepage');
    }
    /*controle que le nombre d'accès est de 1 ..... */
    $nb_acces=0;
    if ($this->charte->getPorteMde()==1) $nb_acces++;
    if ($this->charte->getBatA()==1) $nb_acces++;
    if ($this->charte->getMdeComplete()==1) $nb_acces++;
    if ($this->charte->getLocauxPic()==1) $nb_acces++;
    if ($this->charte->getBureauPolar()==1) $nb_acces++;
    if ($this->charte->getPermPolar()==1) $nb_acces++;
    if ($this->charte->getSallesMusique()==1) $nb_acces++;
    if ($nb_acces!=1)
    {
      $this->getUser()->setFlash('error', 'Vous devez demander un seul accès.');
      $asso=$this->charte->getAsso();
      $this->charte->delete();
      $this->redirect('locaux_charte', $asso);
    }
  }

  public function executeLocauxPost(sfWebRequest $request)
  {
    if(!($this->getUser()->isAuthenticated()))
    {
      $this->redirect('homepage');
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
    }

    $charte_locaux= new CharteLocaux();
    if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
    {
      if($request->getParameter('check') != $this->getUser()->getUserName())
      {
        $this->getUser()->setFlash('error', 'La signature n\'est pas correcte.');
        $this->redirect('homepage');
      }
      $charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id')));
      $charte_locaux->setStatut(1);
      $charte_locaux->save();
      $this->getUser()->setFlash('success', 'La charte a été signée. La demande doit maintenant être validée par le président de l\'association et par le BDE.');
      $this->redirect('homepage');
    }
    $this->redirect('charte');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $charte_locaux = $form->save();
      $this->redirect($this->generateUrl('locaux_ctrl',$charte_locaux));
    }
  }

  public function executeLocauxAccept(sfWebRequest $request)
  {
    $charte_locaux=$this->getRoute()->getObject();
    $this->redirectUnless($charte_locaux, 'homepage');

    $hasdroit=(AssoMemberTable::getInstance()->isPresident($charte_locaux->getAssoId(), $this->getUser()->getGuardUser()->getId()));
    $this->redirectUnless($hasdroit, 'homepage');

    $charte_locaux->setStatut(2);
    $charte_locaux->save();
    $this->getUser()->setFlash('success', 'Le président a validé la charte. La demande doit maintenant être validée par le BDE.');
    $this->redirect('homepage');
  }

  public function executeLocauxRefuse(sfWebRequest $request)
  {
    $charte_locaux=$this->getRoute()->getObject();
    $this->redirectUnless($charte_locaux, 'homepage');

    $hasdroit=(AssoMemberTable::getInstance()->isPresident($charte_locaux->getAssoId(), $this->getUser()->getGuardUser()->getId()));
    $this->redirectUnless($hasdroit, 'homepage');

    $charte_locaux->delete();
    $this->getUser()->setFlash('success', 'Le président a refusé la charte. La requête a été supprimée');
    $this->redirect('homepage');
  }
}
