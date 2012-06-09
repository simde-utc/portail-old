<?php

/**
 * emprunt actions.
 *
 * @package    simde
 * @subpackage emprunt
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class empruntActions extends sfActions
{

  public function executeNew(sfWebRequest $request)
  {
    $this->materiel = $this->getRoute()->getObject();
    $emprunt = new Emprunt();
    $emprunt->setUser($this->getUser()->getGuardUser());
    $emprunt->setRendu(false);
    $emprunt->setRecu(true);
    $emprunt->setAsso($this->materiel->getAsso());
    $emprunt->setMateriel($this->materiel);
    $this->form = new EmpruntForm($emprunt);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->materiel = MaterielTable::getInstance()->find($request->getPostParameter('emprunt[materiel_id]'));
    $emprunt = new Emprunt();
    $emprunt->setMaterielId($this->materiel->getId());
    $this->form = new EmpruntForm($emprunt);

    if($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
      if($this->form->isValid())
      {
        if($emprunt->emprunter($this->form))
          $this->getUser()->setFlash('success', 'Vous avez emprunté '.$request->getPostParameter('emprunt[materiel_id]').'x '.$emprunt->getMateriel()->getNom().'.');
        else
          $this->getUser()->setFlash('error', 'Impossible d\'emprunter '.$request->getPostParameter('emprunt[materiel_id]').'x '.$emprunt->getMateriel()->getNom().', pas assez de stock.');


        $this->redirect('materiel', $this->materiel->getAsso());
      }
    }

    $this->setTemplate('new');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($emprunt = Doctrine_Core::getTable('Emprunt')->find(array($request->getParameter('id'))), sprintf('Object emprunt does not exist (%s).', $request->getParameter('id')));
    $materiel = $emprunt->getMateriel();
    $emprunt->rendre();
    $emprunt->delete();

    $this->redirect('materiel', $materiel->getAsso());
  }

  public function executeRendre(sfWebRequest $request)
  {
    $this->forward404Unless($emprunt = $this->getRoute()->getObject(), sprintf('Object emprunt does not exist (%s).', $request->getParameter('id')));
    $materiel = $emprunt->getMateriel();
    $emprunt->rendre();
    $this->getUser()->setFlash('success', 'Vous avez rendu '.$emprunt->getNombre().' '.$emprunt->getMateriel()->getNom().'.');
    $this->redirect('materiel', $materiel->getAsso());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $emprunt = $form->save();

      $this->redirect('materiel', $emprunt->getMateriel()->getAsso());
    }
  }

}
