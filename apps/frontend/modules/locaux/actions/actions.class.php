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

  }

  public function executeLocauxCtrl(sfWebRequest $request)
  {
    $this->form = new CharteLocauxForm();
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

      $this->redirect('locaux/edit?id='.$charte_locaux->getId());
    }
  }
}
