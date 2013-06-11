<?php

/**
 * InfoJob actions.
 *
 * @package    simde
 * @subpackage infojob
 * @author     Soukaina B, Maureen C, Yoan T
 */
class infojobActions extends sfActions {

  public function executeIndex(sfWebRequest $request)
  {
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->annonce = $this->getRoute()->getObject();
  }

  public function executeOffres(sfWebRequest $request)
  {
    $this->filters = new InfoJobOffreFormFilter();
    if($request->getMethod() == sfRequest::POST)
    {
      $this->filters->bind($request->getParameter($this->filters->getName()));
      if($this->filters->isValid())
      {
        $query = $this->filters->buildQuery($this->filters->getValues());
      }
    }
    else {
      $query = Doctrine_Core::getTable('InfoJobOffre')
          ->createQuery('a')
          ->limit(5)
          ->orderBy('a.created_at DESC');
    }
    $this->annonces = $query->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new InfoJobOffreForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new InfoJobOffreForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $query = Doctrine_Core::getTable('InfoJobOffre')
        ->createQuery('a')
        ->where('a.emailkey = ?', $request->getParameter('key'));
    $annonce = $query->execute()[0];
    $this->forward404Unless(!empty($annonce), sprintf('Object annonce does not exist (%s).', $request->getParameter('key')));
    $this->form = new InfoJobOffreForm($annonce);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $query = Doctrine_Core::getTable('InfoJobOffre')
        ->createQuery('a')
        ->where('a.emailkey = ?', $request->getParameter('key'));
    $annonce = $query->execute()[0];
    $this->forward404Unless(!empty($annonce), sprintf('Object annonce does not exist (%s).', $request->getParameter('key')));
    $this->form = new InfoJobOffreForm($annonce);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $query = Doctrine_Core::getTable('InfoJobOffre')
        ->createQuery('a')
        ->where('a.emailkey = ?', $request->getParameter('key'));
    $annonce = $query->execute()[0];
    $this->forward404Unless(!empty($annonce), sprintf('Object annonce does not exist (%s).', $request->getParameter('key')));
    $annonce->delete();

    $this->redirect('annonce/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      // TODO Vérifier que la clé générée est unique.
      $form->setEmailkey(md5(microtime().rand()));
      if($this->getUser()->isAuthenticated())
        $form->setUserId($this->getUser()->getGuardUser()->getId());
      // Ajouter la date de création et de mise à jour.
      $form->setCreatedAt(now());
      $form->setUpdatedAt(now());

      $annonce = $form->save();
      // TODO Envoyer email.

      $this->redirect('annonce/edit?key=' . $annonce->getEmailkey());
    }
  }

  public function executeEmail(sfWebRequest $request)
  {
    // TODO
  }

  public function executeSignal(sfWebRequest $request)
  {
    // TODO
  }

  public function executeSignaldo(sfWebRequest $request)
  {
    // TODO
  }
  
  public function executeMonprofil(sfWebRequest $request)
  {
  }
}

