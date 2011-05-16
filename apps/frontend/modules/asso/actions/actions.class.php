<?php

/**
 * asso actions.
 *
 * @package    simde
 * @subpackage asso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assoActions extends sfActions
{
  /**
   * Liste des associations
   * On affiche la liste de toutes les assos
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $this->assos = AssoTable::getInstance()->getAssosList();
    $this->setTemplate('list');
  }
  
  /**
   * Liste des associations
   * On affiche la liste des asso du pôle spécifié
   *
   * @param sfRequest $request A request object
   */
  public function executeList(sfWebRequest $request)
  {
    try {
      $this->pole = $this->getRoute()->getObject();
    }
    catch (Exception $e) {
      $this->forward('asso','index');
    }

    $this->assos = AssoTable::getInstance()->getAssosList($this->pole->getPrimaryKey());
  }

  /**
   * 
   * 
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso->getId());
    $this->events = EventTable::getInstance()->getEventsList($this->asso->getId());
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($asso = Doctrine_Core::getTable('asso')->find(array($request->getParameter('id'))), sprintf('Object asso does not exist (%s).', $request->getParameter('id')));
    $this->form = new assoForm($asso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asso = Doctrine_Core::getTable('asso')->find(array($request->getParameter('id'))), sprintf('Object asso does not exist (%s).', $request->getParameter('id')));
    $this->form = new assoForm($asso);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $asso = $form->save();

      $this->redirect('asso/edit?id='.$asso->getId());
    }
  }

}
