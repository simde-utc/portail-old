<?php

/**
 * weekmail actions.
 *
 * @package    simde
 * @subpackage weekmail
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class weekmailActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->articles = ArticleTable::getInstance()->getArticlesForWeekmail()->execute();
    $this->events = EventTable::getInstance()->getEventsForWeekmail()->execute();
    $this->weekmails = WeekmailTable::getInstance()->getLast()->execute();
    $this->current_weekmails = WeekmailTable::getInstance()->getCurrent()->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new WeekmailForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new WeekmailForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    $this->form = new WeekmailForm($weekmail);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    $this->form = new WeekmailForm($weekmail);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($weekmail = Doctrine_Core::getTable('Weekmail')->find(array($request->getParameter('id'))), sprintf('Object weekmail does not exist (%s).', $request->getParameter('id')));
    foreach($weekmail->getWeekmailArticle() as $article) {
     $article->delete();   
    }
    $weekmail->delete();

    $this->redirect('weekmail/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $weekmail = $form->save();

      $this->redirect('weekmail/index');
    }
  }
  
  public function executePublish(sfWebRequest $request) {
      $weekmail = $this->getRoute()->getObject();
      $weekmail->setPublishedAt(date('Y-m-d',strtotime("next Monday")));
      $weekmail->save();
      $this->redirect('weekmail/index');
  }
  
  public function executeRefuse(sfWebRequest $request) {
      $article = $this->getRoute()->getObject();
      $article->setIsWeekmail(false);
      $article->save();
      $this->redirect('weekmail/index');
  }
  
  public function executeAccept(sfWebRequest $request) {
      $weekmail = WeekmailTable::getInstance()->getCurrent()->fetchOne();
      if(!$weekmail) {
          $this->getUser()->setFlash('error', 'Aucun Weekmail en attente de publication !');
          $this->redirect('weekmail/index');
      }
      
      $article = $this->getRoute()->getObject();
      $article->setIsWeekmail(false);
      
      $weekmail_article = new WeekmailArticle();
      $weekmail_article->setAssoId($article->getAssoId());
      $weekmail_article->setName($article->getName());
      $weekmail_article->setText($article->getText());
      $weekmail_article->setImage($article->getImage());
      $weekmail_article->setSummary($article->getSummary());
      $weekmail_article->setWeekmailId($weekmail->getId());
      $weekmail_article->setArticleId($article->getId());
      
      $weekmail_article->save();
      $article->save();
      $this->redirect('weekmail/index');
  }

  public function executeRefuseEvent(sfWebRequest $request) {
      $event = $this->getRoute()->getObject();
      $event->setIsWeekmail(false);
      $event->save();
      $this->redirect('weekmail/index');
  }
  
  public function executeAcceptEvent(sfWebRequest $request) {
      $weekmail = WeekmailTable::getInstance()->getCurrent()->fetchOne();
      if(!$weekmail) {
          $this->getUser()->setFlash('error', 'Aucun Weekmail en attente de publication !');
          $this->redirect('weekmail/index');
      }
      
      $event = $this->getRoute()->getObject();
      $event->setIsWeekmail(false);
      
      $weekmail_article = new WeekmailArticle();
      $weekmail_article->setAssoId($event->getAssoId());
      $weekmail_article->setName($event->getName());
      $weekmail_article->setText($event->getDescription());
      $weekmail_article->setImage($event->getAffiche());
      $weekmail_article->setSummary($event->getSummary());
      $weekmail_article->setWeekmailId($weekmail->getId());
      $weekmail_article->setEventId($event->getId());
      
      $weekmail_article->save();
      $event->save();
      $this->redirect('weekmail/index');
  }
  
  public function executeDeleteArticle(sfWebRequest $request)
  {
    $article = $this->getRoute()->getObject();
    $article->delete();

    $this->redirect('weekmail/index');
  }

  public function executeHtml() {
    $this->weekmail = $this->getRoute()->getObject();
    $this->rows = 12
      + WeekmailArticleTable::getInstance()
        ->getEventsForWeekmail($this->weekmail->getId())->count() * 3
      + WeekmailArticleTable::getInstance()
        ->getArticlesForWeekmail($this->weekmail->getId())->count() * 3
      ;

    $months = array(
      1 => 'janvier',
      2 => 'février',
      3 => 'mars',
      4 => 'avril',
      5 => 'mai',
      6 => 'juin',
      7 => 'juillet',
      8 => 'août',
      9 => 'septembre',
      10 => 'octobre',
      11 => 'novembre',
      12 => 'décembre'
    );
    $datetime = new DateTime($this->weekmail->getPublishedAt());
    $this->date = 'du ';
    $this->date .= $datetime->format("d");
    $old = clone $datetime;
    $datetime->add(new DateInterval('P7D'));
    if($old->format("m") != $datetime->format("m")) {
      $this->date .= ' ';
      $this->date .= $months[intval($old->format("m"))];
    }
    $this->date .= ' au ';
    $this->date .= $datetime->format("d");
    $this->date .= ' ';
    $this->date .= $months[intval($datetime->format("m"))];
  }
}
