<?php

/**
 * InfoJob actions.
 *
 * @package    simde
 * @subpackage infojob
 * @author     Soukaina B, Maureen C, Yoan T
 */
class infojobActions extends sfActions {
  
  public function executeShow(sfWebRequest $request)
  {
    $annonce = InfoJobOffreTable::getInstance()->getOffreById($request->getParameter('id'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas ou a été archivée (%s).', $request->getParameter('id')));
    $this->annonce = $annonce;
  }

  public function executeOffres(sfWebRequest $request)
  {
	  $this->filters = new InfoJobOffreFormFilter();
    if($request->getMethod() == sfRequest::POST) {
      $this->filters->bind($request->getParameter($this->filters->getName()));
      if($this->filters->isValid())
      	$query = $this->filters->buildQuery($this->filters->getValues());
        $query = InfoJobOffreTable::getInstance()->addStandardFilters($query)->orderBy('created_at DESC');
    }
    else {
      $query = InfoJobOffreTable::getInstance()->getLastOffreList();
    }
    $this->pager = new sfDoctrinePager('InfoJobOffre', sfConfig::get('app_portail_offres_par_page'));
    $this->pager->setQuery($query);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->annonces = $this->pager->getResults();
    $this->isGet = $request->getMethod() == sfRequest::GET;
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new InfoJobOffreForm();
    $this->form->setDefault('expiration_date', NULL);
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->form = new InfoJobOffreForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $annonce = InfoJobOffreTable::getInstance()->getOffreByEmailKey($request->getParameter('key'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas (%s).', $request->getParameter('key')));
    $this->form = new InfoJobOffreForm($annonce);
    // Si l'annonce n'a pas encore été validée, afficher une notification.
    if($annonce->getValidationDate() == NULL)
      $this->getUser()->setFlash('warning', 'Cette annonce n\'a pas encore été validée. Veuillez suivre le lien envoyé par email pour que l\'annonce soit publiée.');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $annonce = InfoJobOffreTable::getInstance()->getOffreByEmailKey($request->getParameter('key'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas (%s).', $request->getParameter('key')));
    $this->form = new InfoJobOffreForm($annonce);
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();
    $annonce = InfoJobOffreTable::getInstance()->getOffreByEmailKey($request->getParameter('key'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas (%s).', $request->getParameter('key')));
    $annonce->archive();
    $this->redirect('infojob_home');
  }
  
  public function executeActivate(sfWebRequest $request)
  {
    $annonce = InfoJobOffreTable::getInstance()->getOffreByEmailKey($request->getParameter('key'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas (%s).', $request->getParameter('key')));
    if($annonce->getValidationDate() != NULL) {
      $this->getUser()->setFlash('warning', 'L\'annonce a déjà été activée.');
      $this->redirect('infojob_offre_show', array('id' => $annonce->getId()));
    }
    $annonce->activate();
    $this->getUser()->setFlash('success', 'L\'annonce a bien été activée.');
    $this->redirect('infojob_offre_show', array('id' => $annonce->getId()));
  }

  public function executeSignal(sfWebRequest $request)
  {
    $this->form = new InfoJobSignalementForm();
    $this->form->setDefault('offre_id', $request->getParameter('id'));
    $this->form->getObject()->setOffreId($request->getParameter('id'));
  }

  public function executeSignaldo(sfWebRequest $request)
  { 
  	$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->form = new InfoJobSignalementForm();
    $this->processFormSignalement($request, $this->form);
    $this->setTemplate('signal');
  }
  
  public function executeMyoffer(sfWebRequest $request)
  {
    $annonce = InfoJobOffreTable::getInstance()->getOffreById($request->getParameter('id'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas ou a été archivée (%s).', $request->getParameter('id')));
    $this->annonce = $annonce;
  }

  public function executeMyofferdo(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $annonce = InfoJobOffreTable::getInstance()->getOffreById($request->getPostParameter('offre_id'))->fetchOne();
    $this->forward404Unless($annonce != null, sprintf('L\'annonce n\'existe pas ou a été archivée (%s).', $request->getParameter('id')));
    $this->annonce = $annonce;
    // Envoyer l'email.
    $message = Swift_Message::newInstance()
          ->setFrom(sfConfig::get('app_portail_infojob_email'))
          ->setTo($annonce->getEmail())
          ->setSubject('Modification de votre annonce sur InfoJob');
    $message->setBody($this->getPartial('myofferemail', array('annonce' =>$annonce)), 'text/html');
    $this->getMailer()->send($message);
    $this->getUser()->setFlash('success', 'Un email vient de vous être envoyé.');
    $this->redirect('infojob_offre_show', array('id' => $annonce->getId()));
  }
  
  public function executeMonprofil(sfWebRequest $request)
  {
    // TODO.
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $isNew = $form->getObject()->isNew();
      if($isNew) {
        // TODO Vérifier que la clé générée est unique.
        $form->getObject()->setEmailkey(md5(microtime().rand()));
        $form->getObject()->setValidationkey(md5(microtime().rand()));
        if($this->getUser()->isAuthenticated())
          $form->getObject()->setUserId($this->getUser()->getGuardUser()->getId());
        // Ajouter la date de création et de mise à jour.
        $form->getObject()->setDateTimeObject('created_at', new DateTime());
      	$form->getObject()->setDateTimeObject('updated_at', new DateTime());
      }
      $annonce = $form->save();
      if($isNew) {
        // Si l'annonce vient d'être créée.
        $this->getUser()->setFlash('success', 'L\'annonce a bien été créée. Vous allez recevoir prochainement un email pour valider sa publication.');
        // Envoyer l'email de validation.
        $message = Swift_Message::newInstance()
          ->setFrom(sfConfig::get('app_portail_infojob_email'))
          ->setTo($annonce->getEmail())
          ->setSubject('Création de votre annonce sur InfoJob');
        $message->setBody($this->getPartial('validationemail', array('annonce' =>$annonce)), 'text/html');
        $this->getMailer()->send($message);
      }
      else
        $this->getUser()->setFlash('success', 'L\'annonce a bien été mise à jour.');
      $this->redirect('infojob_offre_edit', array('key' => $annonce->getEmailkey()));
    }
  }
  
  protected function processFormSignalement(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      // Ajouter la date de création et de mise à jour.
      $form->getObject()->setDateTimeObject('created_at', new DateTime());
    	$form->getObject()->setDateTimeObject('updated_at', new DateTime());
      $signalement = $form->save();
      $this->getUser()->setFlash('success','L\'annonce a bien été signalée et sera vérifiée prochainement par le BDE-UTC.');
      $this->redirect('infojob_offre_show', array('id' => $signalement->getOffreId()));
    }
  }
}

