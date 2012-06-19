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
          $pole = PoleTable::getInstance()->findOneBy('asso_id',$this->asso->getId());
          $this->assos = AssoTable::getInstance()->getAssosList($pole->getId())->execute();
        }
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->redirectUnless($asso = $this->getRoute()->getObject(), 'assos_list');
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x01))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $this->form = new AssoForm($asso);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($asso = Doctrine_Core::getTable('asso')->find(array($request->getParameter('id'))), sprintf('Object asso does not exist (%s).', $request->getParameter('id')));
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($asso->getLogin(), 0x01))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $this->form = new AssoForm($asso);
    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if($form->isValid())
    {
      $asso = $form->save();

      $this->redirect('asso/show?login='.$asso->getLogin());
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

<<<<<<< HEAD
  public function executeBureau()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    $this->bureau = AssoMemberTable::getInstance()->getBureau($this->asso)->execute();
  }
  
  public function executeAlbums()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    $this->albums = AlbumTable::getInstance()->getAlbumsList($this->asso)->execute();
  }

=======
>>>>>>> 26ff3013cc4044e1aba25f4ae179891e3097e882
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
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être connecté pour rejoindre une association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    if($this->getUser()->getGuardUser()->isMember($asso->getLogin()))
    {
      $this->getUser()->setFlash('error', 'Vous êtes déjà inscrit à cette association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $asso->addMember($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous êtes maintenant membre de cette association.');
    $this->redirect('asso/show?login='.$asso->getLogin());
  }

  public function executeLeave()
  {
    $asso = $this->getRoute()->getObject();
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être déconnecté pour quitter une association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    if(!$this->getUser()->getGuardUser()->isMember($asso->getLogin()))
    {
      $this->getUser()->setFlash('error', 'Vous n\'êtes pas inscrit à cette association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $asso->removeMember($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous n\'êtes plus membre de cette association.');
    $this->redirect('asso/show?login='.$asso->getLogin());
  }
  public function executeFollow()
  {
    $asso = $this->getRoute()->getObject();
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être connecté pour suivre les actualits d\'une association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    if($this->getUser()->getGuardUser()->isFollower($asso->getId()))
    {
      $this->getUser()->setFlash('error', 'Vous suivez déjà les actualités de cette association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $asso->addFollower($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous suivez maintenant les actualités de cette association.');
    $this->redirect('asso/show?login='.$asso->getLogin());
  }

  public function executeUnfollow()
  {
    $asso = $this->getRoute()->getObject();
    if(!$this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('error', 'Vous devez être connecté pour quitter une association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    if(!$this->getUser()->getGuardUser()->isFollower($asso->getId()))
    {
      $this->getUser()->setFlash('error', 'Vous ne suivez pas les actualités de cette association.');
      $this->redirect('asso/show?login='.$asso->getLogin());
    }
    $asso->removeFollower($this->getUser()->getGuardUser());
    $this->getUser()->setFlash('success', 'Vous ne suivez plus les actualités de cette association.');
    $this->redirect('asso/show?login='.$asso->getLogin());
  }

  public function executeMember()
  {
    $this->asso = $this->getRoute()->getObject();
    $this->redirectUnless($this->asso, 'assos_list');
    if(!$this->getUser()->isAuthenticated() || !$this->getUser()->getGuardUser()->hasAccess($this->asso->getLogin(), 0x02))
    {
      $this->getUser()->setFlash('error', 'Vous n\'avez pas le droit d\'effectuer cette action.');
      $this->redirect('asso/show?login='.$this->asso->getLogin());
    }
    $this->membres = AssoMemberTable::getInstance()->getMembres($this->asso)->andWhere('q.role_id <> 1')->execute();
    
    $this->roles = RoleTable::getInstance()->findAll();
  }

}
