<?php

require_once dirname(__FILE__).'/../lib/infojob_signalementGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/infojob_signalementGeneratorHelper.class.php';

/**
 * infojob_signalement actions.
 *
 * @package    simde
 * @subpackage infojob_signalement
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class infojob_signalementActions extends autoInfojob_signalementActions
{
  public function executeBatchValider(sfWebRequest $request) {
    $ids = $request->getParameter('ids');
    $q = Doctrine_Query::create()
      ->from('InfoJobSignalement a')
      ->whereIn('a.id', $ids);
    foreach ($q->execute() as $signalement) {
      $offre = Doctrine_Core::getTable('InfoJobOffre')->find($signalement->getOffreId());
      $offre->archive();
      $signalement->archive();
    }
    $this->getUser()->setFlash('notice', 'Les annonces correspondantes ont bien été archivées.');
    $this->redirect('info_job_signalement');
  }

  public function executeListValider(sfWebRequest $request)
  {
    $signalement = $this->getRoute()->getObject();
    $offre = Doctrine_Core::getTable('InfoJobOffre')->find($signalement->getOffreId());
    $offre->archive();
    $signalement->archive();
    $this->getUser()->setFlash('notice', 'L\'annonce correspondante a bien été archivée.');
    $this->redirect('info_job_signalement');
  }

  public function executeBatchAnnuler(sfWebRequest $request) {
    $ids = $request->getParameter('ids');
    $q = Doctrine_Query::create()
      ->from('InfoJobSignalement a')
      ->whereIn('a.id', $ids);
    foreach ($q->execute() as $signalement) {
      $signalement->archive();
    }
    $this->getUser()->setFlash('notice', 'Les signalements ont étés archivés sans être pris en compte.');
    $this->redirect('info_job_signalement');
  }

  public function executeListAnnuler(sfWebRequest $request)
  {
    $signalement = $this->getRoute()->getObject();
    $signalement->archive();
    $this->getUser()->setFlash('notice', 'Le signalement a été archivé sans être pris en compte.');
    $this->redirect('info_job_signalement');
  }

  protected function buildQuery()
  {
    return parent::buildQuery()
      ->andWhere('archivage_date IS NULL');
  }
}
