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
    $this->form = new CharteLocauxForm();
    $this->form->setDefault('asso_id', $this->asso->getPrimaryKey());
   }

    public function executeCreate(sfWebRequest $request) {
      $this->form = new CharteLocauxForm();
      if($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT))
          $this->processForm($request, $this->form);
      $this->setTemplate('charte');
    }


  public function executeLocauxCtrl(sfWebRequest $request)
  {
	$this->charte = $this->getRoute()->getObject();
  }

  public function executeLocauxPost(sfWebRequest $request)
  {
    if($request->getParameter('check') != $this->getUser()->getUserName())
    {
      $this->getUser()->setFlash('error', 'La signature n\'est pas correcte.');
      $this->redirect('locaux_charte');
    }
    $charte = new CharteLocaux();
    $charte->setLogin($this->getUser()->getGuardUser()->getUserName());
    $charte->setUserId($this->getUser()->getGuardUser()->getId());
    $charte->setStatut(0);
    $charte->setPorteMde($_POST['porte_mde']);
    $charte->setBatA($_POST['bat_a']);
    $charte->setLocauxPic($_POST['locaux_pic']);
    $charte->setBureauPolar($_POST['bureau_polar']);
    $charte->setPermPolar($_POST['perm_polar']);
    $charte->setMdeComplete($_POST['mde_complete']);
    $charte->setSallesMusique($_POST['salles_musique']);
    $charte->setAssoId($_POST['asso_id']);
    $charte->setIp($_SERVER['REMOTE_ADDR']);
    $charte->setSemestreId(sfConfig::get('app_portail_current_semestre'));
    $charte->setDate(date('Y-m-d H:i:s'));
    $charte->setMotif($_POST['motif']);
    $charte->save();

    $this->getUser()->setFlash('success', 'La charte a été signée. La demande doit maintenant être validée par le président de l\'association et par le BDE.');
    $this->redirect('homepage');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id'))), sprintf('Object charte_locaux does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharteLocauxForm($charte_locaux);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($charte_locaux = Doctrine_Core::getTable('CharteLocaux')->find(array($request->getParameter('id'))), sprintf('Object charte_locaux does not exist (%s).', $request->getParameter('id')));
    $this->form = new CharteLocauxForm($charte_locaux);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
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
}
