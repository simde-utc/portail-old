<?php

/**
 * asso actions.
 *
 * @package    simde
 * @subpackage asso
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class assoActions extends sfActions {

  /**
   * Liste des associations
   * On affiche la liste de toutes les assos ou du pôle spécifié
   *
   * @param sfRequest $request A request object
   */
  public function executeIndex(sfWebRequest $request)
  {
    // Redirection (car cette page n'est pas présentable)
    $this->redirect('home/index');
    
    $pole_id = $this->getRequestParameter('pole');
    $this->poles = PoleTable::getInstance()->getAllWithInfos()->execute();
    foreach($this->poles as $p)
    {
      if($p->getPrimaryKey() == $pole_id)
      {
        $this->assos = AssoTable::getInstance()->getAssosList($pole_id)->execute();
        break;
      }
    }
    if(!$this->assos)
      $this->assos = AssoTable::getInstance()->getAssosList()->execute();
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
    $this->redirectUnless($this->asso, 'assos_list');
    if($this->asso->isPole())
    {
      $pole = PoleTable::getInstance()->findOneBy('asso_id', $this->asso->getId());
      $this->assos = AssoTable::getInstance()->getAssosList($pole->getId())->execute();
    }

    /*
     * Si par le passé l'utilisateur a été membre de l'association,
     * mais que ce n'est plus le cas actuellement,
     * il faut afficher une alerte l'invitant à se réinscrire.
     */
    if($this->asso->getJoignable()
        && $this->getUser()->isAuthenticated()
        && !$this->getUser()->getGuardUser()->isMember($this->asso->getLogin()))
    {
      $r = AssoMemberTable::getInstance()->getAssoMember($this->asso->getId(), $this->getUser()->getGuardUser()->getId())->execute();
      if($r->count() > 0)
        $this->flashwarn = 'Vous avez été membre de cette association par le passé.<br /> Pour la rejoindre à nouveau <a href="' . $this->generateUrl('asso_join', $this->asso) . '">cliquez ici</a>.';
    }

    /*
     * Si l'utilisateur est l'ancien président et que l'association n'a pas de président  
     *
     */
    $pres = AssoMemberTable::getInstance()->getPresident($this->asso)->fetchOne();
    if($this->getUser()->isAuthenticated() && !$pres
        && ($asso_member = AssoMemberTable::getInstance()->wasPresident($this->asso->getId(), $this->getUser()->getGuardUser()->getId()) || $this->getUser()->getGuardUser()->hasPermission('chartes_valider'))
        && $c = CharteInfoTable::getInstance()->getByAssoAndSemestre($this->asso->getId())->andWhere('q.confirmation = ?', false)->execute())
    {
      if($c->count() > 0)
      {
        $msg = 'En tant qu\'ancien président de cette association, vous devez valider les demandes de passation.<br />
          Les demandes suivantes ont été effectuées :<br /><ul>';
        foreach($c as $charte)
        {
          $msg .= '<li><b>' . $charte->getResponsable()->getName() . '</b> le <em>' . $charte->getDate() . '</em> - <a href="' . $this->generateUrl('asso_charte_confirm', $charte) . '">Confirmer</a> / <a href="' . $this->generateUrl('asso_charte_refuse', $charte) . '">Refuser</a></li>';
        }
        $msg .= '</ul>';
        $this->flashinfo = $msg;
      }
    }
  }

  public function executeCharte(sfWebRequest $request)
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    if(!($this->getUser()->isAuthenticated()
        && $this->getUser()->getGuardUser()->isMember($this->asso->getLogin())))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $this->asso->getLogin());
    }
  }

  public function executeChartePost(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $asso = AssoTable::getInstance()->find($request->getParameter('asso_id'));

    if(!($this->getUser()->isAuthenticated())
        && $this->getUser()->getGuardUser()->isMember($asso->getLogin))
    {
      $pres = AssoMemberTable::getInstance()->getPresident($this->asso)->fetchOne();
      if($pres)
      {
        $this->getUser()->setFlash('warning', 'Cette association a déjà un président.');
      }
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    if(!$request->getParameter('check') == $this->getUser()->getUserName())
    {
      $this->getUser()->setFlash('error', 'La signature n\'est pas correcte.');
      $this->redirect('asso/charte?login=' . $asso->getLogin());
    }
    $charte = new CharteInfo();
    $charte->setAsso($asso);
    $charte->setAssoName($asso->getLogin());
    $charte->setResponsableId($this->getUser()->getGuardUser()->getId());
    $charte->setLogin($this->getUser()->getGuardUser()->getUsername());
    $charte->setIp($_SERVER['REMOTE_ADDR']);
    $charte->setSemestreId(sfConfig::get('app_portail_current_semestre'));
    $charte->setDate(date('Y-m-d H:i:s'));
    $charte->save();

    $this->getUser()->setFlash('success', 'La charte a été signée. La demande doit maintenant être validée par l\'ancien président ou le BDE.');
    $this->redirect('asso/show?login=' . $asso->getLogin());
  }

  public function executeCharteRefuse(sfWebRequest $request)
  {
    // Si la charte n'existe pas => exit
    $charte = $this->getRoute()->getObject();
    $this->redirectUnless($charte, 'assos_list');
    
    // Si pas les droits => exit aussi
    $hasDroit = (AssoMemberTable::getInstance()->wasPresident($charte->getAsso()->getId(), $this->getUser()->getGuardUser()->getId()) || $this->getUser()->getGuardUser()->hasPermission('chartes_valider'));    
    $this->redirectUnless($hasDroit, 'assos_list');

    $asso = $charte->getAsso();
    $charte->delete();

    $this->getUser()->setFlash('success', 'Vous avez refusé une demande de passation.');

    $this->redirect('asso/show?login=' . $asso->getLogin());
  }

  public function executeCharteConfirm(sfWebRequest $request)
  {
    // Si la charte n'existe pas => exit
    $charte = $this->getRoute()->getObject();
    $this->redirectUnless($charte, 'assos_list');
    
    // Si pas les droits => exit aussi
    $hasDroit = (AssoMemberTable::getInstance()->wasPresident($charte->getAsso()->getId(), $this->getUser()->getGuardUser()->getId()) || $this->getUser()->getGuardUser()->hasPermission('chartes_valider'));    
    $this->redirectUnless($hasDroit, 'assos_list');

    $pres = $charte->getResponsable();
    $asso = $charte->getAsso();

    $asso_member = AssoMemberTable::getInstance()->getCurrentAssoMember($asso->getId(), $pres->getId())->fetchOne();
    
    // Si le président a quitté l'asso entre temps...
    if(!$asso_member){
      $asso->addMember($pres);
      $asso_member = AssoMemberTable::getInstance()->getCurrentAssoMember($asso->getId(), $pres->getId())->fetchOne();
    }
    
    $asso_member->setRoleId(1);
    $asso_member->save();

    // Envoi d'un mail de confirmation
    $message = $this->getMailer()->compose(
      array('simde@assos.utc.fr' => 'SiMDE'),
      $pres->getEmailAddress(),
      'Validation de la charte assos',
      <<<EOF
Bonjour,

Votre signature de charte vient d'être validée, vous êtes donc maintenant président de l'association {$asso->getName()}.
 
Rendez-vous sur le portail pour mettre à jour sa page ou attribuer des droits à d'autres membres !

L'équipe du SiMDE
EOF
);
    $this->getMailer()->send($message);
    
    $charte->setConfirmation(true);
    $charte->save();

    $this->getUser()->setFlash('success', 'Le nouveau président est : ' . $pres->getName() . '.');

    $this->redirect('asso/show?login=' . $asso->getLogin());
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->redirectUnless($asso = $this->getRoute()->getObject(), 'assos_list');
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x01))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    $this->form = new AssoFormUser($asso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asso = Doctrine_Core::getTable('asso')->find(array($request->getParameter('id'))), sprintf('Object asso does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x01))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    $this->form = new AssoFormUser($asso);
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $asso = $form->save();

      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
  }

  /**
   * 
   * Find an asso from a string given using zend framework search
   * @param sfWebRequest $request
   */
  public function executeSearch(sfWebRequest $request)
  {
    $this->forwardUnless($query = $request->getParameter('query'), 'asso', 'index');

    $this->assos = Doctrine_Core::getTable('Asso')->getForLuceneQuery($query);

    if($request->isXmlHttpRequest())
    {
      if('*' == $query || !$this->assos)
      {
        return $this->renderText('No results.');
      }

      return $this->renderPartial('asso/list', array('assos' => $this->assos));
    }
  }

  public function executeArticles()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    $this->articles = ArticleTable::getInstance()->getArticlesList($this->asso)->execute();
  }

  public function executeEvents()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    $this->events = EventTable::getInstance()->getEventsList($this->asso)->execute();
  }

  public function executeTrombinoscope()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    $this->bureau = AssoMemberTable::getInstance()->getBureau($this->asso)->execute();
    $this->membres = AssoMemberTable::getInstance()->getMembres($this->asso, false)->execute();
  }

  public function executeJoin()
  {
    $asso = $this->getRoute()->getObject();
    if(!$asso->getJoignable())
    {
      $this->getUser()->setFlash('error', 'On ne peut pas rejoindre cette association.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être connecté pour rejoindre une association.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    if($this->getUser()->getGuardUser()->isMember($asso->getLogin()))
    {
      $this->getUser()->setFlash('error', 'Vous êtes déjà inscrit à cette association.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    $asso->addMember($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous êtes maintenant membre de cette association.');
    $this->redirect('asso/show?login=' . $asso->getLogin());
  }

  public function executeLeave()
  {
    $asso = $this->getRoute()->getObject();
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être déconnecté pour quitter une association.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    if(!$this->getUser()->getGuardUser()->isMember($asso->getLogin()))
    {
      $this->getUser()->setFlash('error', 'Vous n\'êtes pas inscrit à cette association.');
      $this->redirect('asso/show?login=' . $asso->getLogin());
    }
    $asso->removeMember($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous n\'êtes plus membre de cette association.');
    $this->redirect('asso/show?login=' . $asso->getLogin());
  }

  public function executeMember()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($this->asso->getLogin(), 0x02))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login=' . $this->asso->getLogin());
    }
    $this->membres = AssoMemberTable::getInstance()->getMembres($this->asso)->andWhere('q.role_id <> 1')->execute();

    $this->roles = RoleTable::getInstance()->findAll();
  }

}
