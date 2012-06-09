<?php

/**
 * materiel actions.
 *
 * @package    simde
 * @subpackage materiel
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class materielActions extends sfActions {

  public function executeIndex(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->materiels = MaterielTable::getInstance()->getAllByAsso($this->asso)->execute();
    $this->emprunts = EmpruntTable::getInstance()->getAllByAsso($this->asso)->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new MaterielForm();
    $this->form->setDefault('asso_id', $this->getRoute()->getObject()->getId());
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new MaterielForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($materiel = $this->getRoute()->getObject(), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterielForm($materiel);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($materiel = Doctrine_Core::getTable('materiel')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new MaterielForm($materiel);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($materiel = $this->getRoute()->getObject(), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $materiel->delete();

    $this->redirect('materiel/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $materiel = $form->save();

      $this->redirect('materiel', $materiel->getAsso());
    }
  }

  public function executeAjout(sfWebRequest $request)
  {
    $this->materiel = $this->getRoute()->getObject();
    $stock = StockTable::getInstance()->createQuery('q')
        ->andWhere('materiel_id = ?',$this->materiel->getId())
        ->andWhere('etat_id = ?',1)
        ->fetchOne();
    $this->form = new StockForm($stock);
    $this->form->setDefault('materiel_id', $this->materiel->getId());
  }

  public function executeCreateAjout(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new StockForm();

    $this->processFormAjout($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeUpdateAjout(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($stock = Doctrine_Core::getTable('stock')->find(array($request->getParameter('id'))), sprintf('Object materiel does not exist (%s).', $request->getParameter('id')));
    $this->form = new StockForm($stock);

    $this->processFormAjout($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processFormAjout(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $stock = $form->save();

      $this->redirect('materiel', $stock->getMateriel()->getAsso());
    }
  }
}
