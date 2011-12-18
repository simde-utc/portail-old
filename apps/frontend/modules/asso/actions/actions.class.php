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
   * On affiche la liste de toutes les assos ou du pôle spécifié
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    $pole_id = $this->getRequestParameter('pole');
    $this->poles = PoleTable::getInstance()->getAllWithInfos()->execute();
    foreach($this->poles as $p)
    {
      if($p->getPrimaryKey() == $pole_id)
      {
        $this->assos = AssoTable::getInstance()->getAssosList($pole_id);
        break;
      }
    }
    if(!$this->assos)
      $this->assos = AssoTable::getInstance()->getAssosList();
    $this->setTemplate('list');
  }

  /**
   * 
   * 
   * @param sfRequest $request A request object
   */
  public function executeShow(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso,'assos_list');
    if($pole = $this->asso->isPole())
      $this->assos = AssoTable::getInstance()->getAssosList($pole->getPrimaryKey());
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($asso = $this->getRoute()->getObject());
    $this->forward404Unless($this->getUser()->getGuardUser()->hasAccess($asso->getLogin(),0x01));
    $this->form = new AssoForm($asso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asso = Doctrine_Core::getTable('asso')->find(array($request->getParameter('id'))),sprintf('Object asso does not exist (%s).',$request->getParameter('id')));
    $this->form = new AssoForm($asso);
    $this->forward404Unless($this->getUser()->getGuardUser()->hasAccess($asso->getLogin(),0x01));
    $this->processForm($request,$this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request,sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()),$request->getFiles($form->getName()));
    if($form->isValid())
    {
      $asso = $form->save();

      $this->redirect('asso/edit?login='.$asso->getLogin());
    }
  }

  /**
   * 
   * Find an asso from a string given using zend framework search
   * @param sfWebRequest $request
   */
  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'),'asso','index');

    $this->assos = Doctrine_Core::getTable('Asso')->getForLuceneQuery($query);

    if($request->isXmlHttpRequest())
    {
      if('*' == $query || !$this->assos)
      {
        return $this->renderText('No results.');
      }

      return $this->renderPartial('asso/list',array('assos' => $this->assos));
    }
  }

}
